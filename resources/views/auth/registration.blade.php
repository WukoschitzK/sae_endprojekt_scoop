@extends('layouts.master')

@section('title', 'Registration')

@section('container')


    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">Registration</div>

        <p class="text-center margin-bottom-30 font-20-px w-md-40">Create your <span class="text-black">scoop</span> account and be part of an awesome community</p>

        <div>
            <form class="containers shadow form-edit-profile" method="post" action="{{ route('auth.postRegistration') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_name">Name:</label>
                    <input type="text" name="name" value="" class="form-control" id="input_name">
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="" class="form-control" id="input_email">
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="" class="form-control" id="input_password">
                </div>

                <div class="margin-bottom-50 form-edit-profile-wrapper-flex">
                    <label for="input_image" class="text-bold margin-bottom-10">Profile Image</label>
                    <input type="file" name="image" class="form-control" id="input_image">
                </div>

                <div class="cta-btn-wrapper margin-bottom-50">
                    <div class="cta-btn">
                        <button type="submit">
                            sign up
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
