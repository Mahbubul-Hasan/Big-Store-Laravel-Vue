@extends('auth.master')

@section("content")

    <h2>Registration</h2>
    <form class="pb-3" action="{{ route("registration") }}" method="POST">
        @csrf
        <input type="text" class="user active" name="name" value="{{ old("name") }}" placeholder="Name"/>
        <input type="text" class="user active" name="email" value="{{ old("email") }}" placeholder="Email"/>
        <input type="text" class="user active" name="phone_number" value="{{ old("phone_number") }}" placeholder="Phone Number (Optional)"/>
        <input type="password" class="lock active" name="password" placeholder="******"/>

        <div class="txt-center">
            @include("message.message")
        </div>

        <div class="login-bwn">
            <input style="width: 150px" type="submit" value="Registration" name="registration"/>
        </div>
    </form>
@endsection
