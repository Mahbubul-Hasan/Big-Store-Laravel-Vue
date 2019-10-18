@extends("auth.master")

@section("content")

    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="text" class="user active" name="email" value="{{ old("email") }}" placeholder="Email"/>
        <input type="password" class="lock active" name="password" placeholder="******"/>
        
        <div class="txt-center">
            @include("message.message")
        </div>

{{--        <div class="forgot">--}}
{{--            <div class="login-check">--}}
{{--                <label class="checkbox"><input type="checkbox" name="checkbox" checked><i> </i> Remember Me</label>--}}
{{--            </div> --}}
{{--            <div class="login-para">--}}
{{--                <p><a href="#"> Forgot Password? </a></p>--}}
{{--            </div>--}}
{{--            <div class="clear"> </div>--}}
{{--        </div>--}}
        <div class="login-bwn">
            <input type="submit" value="Log in" name="login"/>
        </div>
    </form>

    <div class="login-bottom">
        <h3>Login</h3>
        <p>With your social media account</p>
        <div class="social-icons">
            <div class="button">
                <a class="tw" href="#"> <i class="anc-tw"> </i> <span>Twitter</span>
                    <div class="clear"> </div>
                </a>
                <a class="fa" href="{{ url("login/facebook") }}"> <i class="anc-fa"> </i> <span>Facebook</span>
                    <div class="clear"> </div>
                </a>
                <a class="go" href="{{ url("login/google") }}"><i class="anc-go"> </i><span>Google+</span>
                    <div class="clear"> </div>
                </a>
                <div class="clear"> </div>
            </div>
            <h4>Don,t have an Account? <a href="#"> Register Now!</a></h4>
            <div class="reg-bwn"><a href="{{ route("registration") }}">REGISTER</a></div>
        </div>
    </div>

@endsection
