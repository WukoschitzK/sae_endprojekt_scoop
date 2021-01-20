@extends('layouts.master')

@section('title', 'Registration')

@section('container')


    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">Registration</div>

        <p class="text-center margin-bottom-30 font-20-px w-md-40">Create your <span class="text-black">scoop</span> account and be part of an awesome community</p>

        <div>
            <form class="containers shadow form-edit-profile" method="post" name="registration" action="{{ route('auth.postRegistration') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="profile-image-upload">
                    <div class="profile-image-edit">
                        <input name="image" type="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"></label>
                    </div>

                    <div class="profile-image-preview">
                        <div id="imagePreview" class="current-profile-image" style="background-image: url(/images/avatar.png);">
                        </div>
                    </div>
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_name">Name:</label>
                    <input type="text" name="name" value="" class="form-control" id="input_name">
                    <div class="error">{{ $errors->first('name') }}</div>
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="" class="form-control" id="input_email">
                    <div class="error">{{ $errors->first('email') }}</div>
                </div>

                <div class="form-edit-profile-wrapper-input">
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="" class="form-control" id="input_password">
                    <div class="error">{{ $errors->first('password') }}</div>
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
