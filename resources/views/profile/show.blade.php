@extends('layouts.master')

@section('title', $user->name)

@section('container')


    <div class="wrapper">

        <div class="margin-bottom-30 profile-information-section">

            <div class="profile-information-wrapper">

                @if($user->image_url)
                    <img class="profile-information-image" src="{{ $user->image_url }}">
                @endif

                <img class="profile-information-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />
                <div class="profile-information-text-wrapper">
                    <div class="profile-information-user-name">{{ $user->name }}</div>
                    <div class="profile-information-allergens font-16-px margin-bottom-10">
                        <div>preferred content</div>
                    </div>
                    <div class="profile-information-details">
                        <div class="font-14-px">
                            <div>{{$recipes->count()}}</div>
                            <div>Recipes</div>
                        </div>
                        <div class="font-14-px">
                            <div>{{$followers->count()}}</div>
                            <div>Follower</div>
                        </div>
                    </div>
                </div>
            </div>


            <a href="{{ url('/profile/' . auth()->user()->id) . '/edit' }}">
                <div class="text-right edit-profile-link font-16-px">
                    <i class="fas fa-pencil-alt"></i> Edit Profile
                </div>
            </a>
        </div>

        <div class="h1 heading-line d-inline-block">Newsfeed</div>

        <div class="recipe-cards-wrapper-flex">
            <div class="margin-bottom-50 recipe-element">
{{--                partial recipecard--}}
            </div>

            <div class="margin-bottom-50 recipe-element">
                {{--                partial recipecard--}}
            </div>

            <div class="margin-bottom-50 recipe-element">
                {{--                partial recipecard--}}
            </div>
        </div>

    </div>

@endsection
