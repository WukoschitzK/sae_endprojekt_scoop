@extends('layouts.master')

@section('title', 'Registration')

@section('container')


    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">Registration</div>

        <p class="text-center margin-bottom-30 font-20-px w-md-40">Create your <span class="text-black">scoop</span> account and be part of an awesome community</p>

        <div>
            <form class="containers shadow" method="post" action="{{ route('auth.postRegistration') }}" autocomplete="off">
                @csrf

                <div>
                    <label for="input_name">Name:</label>
                    <input type="text" name="name" value="" class="form-control" id="input_name" placeholder="Enter name">
                </div>

                <div>
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="" class="form-control" id="input_email">
                </div>

                <div>
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="" class="form-control" id="input_password">
                </div>
{{--                <div>--}}
{{--                    <label for="input_password">Password repeat:</label>--}}
{{--                    <input type="password" name="password" value="" class="form-control" id="input_password">--}}
{{--                </div>--}}

                {{--            <div>--}}
                {{--                <input type="checkbox" name="remember_me" id="input_remember">--}}
                {{--                <label for="input_remember">Remember me</label>--}}
                {{--            </div>--}}

                <button type="submit">
                    Sign up
                </button>
            </form>
        </div>
    </div>

@endsection
