@extends('layouts.master')

@section('title', 'Edit')

@section('container')



    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">
            Edit Profile
        </div>

        <form class="form-edit-profile" method="post" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" autocomplete="off">
            @method('put')
            @csrf

            <h3>Profile Information</h3>
            <div class="wrapper-edit-profile-image margin-bottom-30">
                @if($user->image_path)
                    <img class="profile-information-image" src="/storage/images/profile_images/{{ $user->image_path }}">

                @else
                    <img class="profile-information-image" src="/images/profile-image-placeholder.jpg" alt="Profile Image" />
                @endif
                    <div class="">
                        <label for="input_image" class="text-bold margin-bottom-10">Images</label>
                        <input type="file" name="image" class="form-control" id="input_image">
                        <div>Change Image</div>
                    </div>
            </div>



            <div class="form-edit-profile-wrapper-input">
                <label for="input_name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="input_name">
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="input_email">
            </div>

            <div class="form-edit-profile-wrapper-input">
                <label for="input_password">Password:</label>
                <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="input_password">
            </div>

            <div class="margin-bottom-30">
                <h3>Preferred Content</h3>

                <div class="form-recipe-wrapper-input">
                    <ul class="allergen-tiles-wrapper">
                        @foreach($allergens as $allergen)
                            <li class="js-allergen-tile">
                                <label for="input_allergen_{{$allergen->id}}">{{$allergen->name}}</label>
                                <input type="checkbox" name="allergens[]" value="{{$allergen->id}}" id="input_allergen_{{$allergen->id}}" class="tryAllergen">
                            </li>
                        @endforeach
                    </ul>
                </div>

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

	<div class="card mt-4">
		<div class="card-body">



		</div>
	</div>

@endsection
