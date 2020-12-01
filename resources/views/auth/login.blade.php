@extends('layouts.master')

@section('title', 'Login')

@section('container')

    <div class="wrapper">

        <div class="h1 heading-line d-inline-block">Login</div>
        <p class="text-center margin-bottom-30 font-20-px w-md-40">Login to your <span className="text-black">scoop</span> account</p>


        <div>
            <form class="containers" method="post" action="{{ route('auth.postLogin') }}" autocomplete="off">
                @csrf

                <div>
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="" id="input_email" placeholder="Enter email">
                </div>

                <div>
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="" id="input_password" placeholder="Enter password">
                </div>


                <button class="text-center mb-4">
                    Sign In
                </button>
            </form>
        </div>

    </div>









@endsection
