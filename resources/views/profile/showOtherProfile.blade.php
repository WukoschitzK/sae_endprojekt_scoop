@extends('layouts.master')

@section('title', $user->name)

@section('container')

    <div class="wrapper">

        @if(Session::has('success'))
            <div class="notification-container">
                <div class="notification-background">
                    <div class="notification-text">

                        <p class="success">{{ Session::get('success') }}</p>

                    </div>
                </div>
            </div>
        @endif

        <div class="margin-bottom-30 profile-information-section">

            <div class="profile-information-wrapper">

                @if($user->image_path)
                    <img class="profile-information-image" src="/storage/images/profile_images/{{ $user->image_path }}">

                @else
                    <img class="profile-information-image" src="../images/avatar.png" alt="Profile Image" />
                @endif


                <div class="profile-information-text-wrapper">
                    <div class="profile-information-user-name">{{ $user->name }}</div>
                    <div class="profile-information-allergens font-16-px margin-bottom-10">
                        <div>{{ $user->preferred_content }}</div>
                    </div>
                    <div class="profile-information-details">
                        <div class="font-14-px">
                            <div>{{$user->recipes()->count()}}</div>
                            <div>Recipes</div>
                        </div>
                        <div class="font-14-px">
                            <div>{{$user->followers()->count()}}</div>
                            <div>Follower</div>
                        </div>
                    </div>
                </div>
            </div>

{{--            todo: if i follow this user, show unfollow btn--}}
            @if(auth()->check())
                @if( $user->id != auth()->user()->id && !$isAlreadyFollowing)
                <div class="margin-bottom-50 cta-btn-right">
                    <div class="cta-btn-wrapper cta-btn-small">
                        <div class="cta-btn-sm">
                            <form method="post" action="{{ route('profile.follow', $user->id) }}" autocomplete="off")">
                            @csrf

                                <button type="follow" class="btn btn-info mt-2">
                                    Follow
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endif
            @if($isAlreadyFollowing)
                <div class="margin-bottom-50 cta-btn-right cta-btn-unfollow">
                    <div class="cta-btn-wrapper cta-btn-small">
                        <div class="cta-btn-sm">
                            <form method="post" action="{{ route('profile.unfollow', $user->id) }}" autocomplete="off">
                            @csrf
                                <button type="unfollow" class="btn btn-warning mt-2">
                                    Unfollow
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="h1 heading-line d-inline-block">Recipes</div>


        <div class="recipe-cards-wrapper-flex">
            @foreach($recipes as $recipe)
                <div class="margin-bottom-50 recipe-element">
                        <a href="{{ route('recipes.show', $recipe->id) }}">
                            <div class="recipe-card">
                                <div>

                                    @if($recipe->image_path)
                                        <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                                    @else
                                        <img class="recipe-detail-img" src="/images/recipe-image-placeholder.svg" alt="Placeholderimage of Recipe" />
                                    @endif
                                </div>
                                <div class="recipe-card-text">
                                    <h2>{{ $recipe->title }}</h2>
                                    <p>{{ $recipe->description }}</p>
                                </div>
                            </div>
                        </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
