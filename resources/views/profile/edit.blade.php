@extends('layouts.master')

@section('title', 'Edit Profile')

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">
            Edit Profile
        </div>

        <form class="form-edit-profile" method="post" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" autocomplete="off">
            @method('put')
            @csrf

            <div class="wrapper-edit-profile-image margin-bottom-30">
                    <div class="profile-image-upload">
                        <div class="profile-image-edit">
                            <input name="image" type="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="profile-image-preview">
                            @if($user->image_path)
                                <div id="imagePreview" class="current-profile-image" style="background-image: url(/storage/images/profile_images/{{ $user->image_path }});">
                                </div>
                            @else
                                <div id="imagePreview" class="current-profile-image" style="background-image: url(/images/avatar.png{{ $user->image_path }});">
                                </div>
                            @endif
                        </div>
                    </div>
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_name">Name <span class="required-star">*</span></label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="input_name">
                <div class="error">{{ $errors->first('name') }}</div>
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_email">Email <span class="required-star">*</span></label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="input_email">
                <div class="error">{{ $errors->first('email') }}</div>
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_password">Password <span class="required-star">*</span></label>
                <input type="password" name="password" class="form-control" id="input_password">
                <div class="error">{{ $errors->first('password') }}</div>
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_preferred_content">What are your recipes about <span class="required-star">*</span></label>
                <input type="text" name="preferred_content" value="{{ $user->preferred_content }}" class="form-control" id="input_preferred_content">
                <div class="error">{{ $errors->first('preferred_content') }}</div>
            </div>

            <div class="cta-btn-wrapper margin-bottom-50">
                <div class="cta-btn">
                    <button type="submit">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection
