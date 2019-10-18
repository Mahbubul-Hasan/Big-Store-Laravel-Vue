<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use App\Notifications\RegistrationMailNotification;

class AuthController extends Controller
{

    public function showRegistrationForm()
    {
        return view("auth.registration.registration");
    }
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else
        {
            $user = new User();
            $user->saveNewUserInfo($request, $user);


            $user->notify(new RegistrationMailNotification($user));

            $this->setSuccessMessage("Account registered. Please check your email.");

            return redirect("/login");
        }
    }

    public function accountActive($token = null)
    {
        if ($token == null)
            return redirect("login");

        $user = User::where("email_verification_token", $token)->first();

        if ($user)
        {
//            $user->update([
//                "email_verification_token" => null,
//                "email_verified_at" => Carbon::now()
//            ]);

            $user->email_verification_token = "";
            $user->email_verified_at = Carbon::now();
            $user->save();

            $this->setSuccessMessage("Account activated. You can login");

            return redirect("/login");
        }
        else
        {
            $this->setErrorMessage("Invalid token");

            return redirect("/login");
        }
    }

    public function showLoginForm()
    {
        return view("auth.login.login");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)){
            if (auth()->user()->email_verified_at == null)
            {
                $this->setErrorMessage("Your account is not active. Please check your email.");
                return redirect("/login");
            }
            else{
                if (auth()->user()->role == 1) {
                    return redirect('/admin/home');
                }
                else{
                    return redirect('/');
                }
            }
        }
        else {
            $this->setErrorMessage("Email or password is wrong. Please try again");
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    // Socialite--------------------------------------------------

    public function redirectToProvider($socialite)
    {
        return Socialite::driver($socialite)->redirect();
    }

    public function handleProviderCallback($socialite)
    {
        $user = Socialite::driver($socialite)->user();

        $existUser = User::where("email", $user->getEmail())->first();

        if ($existUser) {
            Auth::login($existUser);
        }
        else
        {
            $newUser = new User;

            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(123456);
            $newUser->save();

            Auth::login($newUser);
        }
        return redirect("/");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }

}
