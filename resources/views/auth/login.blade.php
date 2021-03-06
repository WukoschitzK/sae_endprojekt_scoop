@extends('layouts.master')

@section('title', 'Login ')

@section('container')

    <div class="wrapper">

        <div class="h1 heading-line d-inline-block">Login</div>
        <p class="text-center margin-bottom-30 font-20-px w-md-40">Login to your <span class="text-black">scoop</span> account</p>

        <div>
            <form class="containers form-edit-profile" method="post" name="login" action="{{ route('auth.postLogin') }}" autocomplete="off">
                @csrf

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="" id="input_email" placeholder="Enter email">
                    <div class="error">{{ $errors->first('email') }}</div>
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="" id="input_password" placeholder="Enter password">
                    <div class="error">{{ $errors->first('password') }}</div>
                </div>


                <div class="cta-btn-wrapper margin-bottom-50">
                    <div class="cta-btn">
                        <button type="submit">
                            sign in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
