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


            <a href="{{ url('/profile/' . auth()->user()->id) . '/edit' }}">
                <div class="text-right edit-profile-link font-16-px">
                    <i class="fas fa-pencil-alt"></i> Edit Profile
                </div>
            </a>
        </div>

        <div class="h1 heading-line d-inline-block">Newsfeed</div>

        @if($recipes->isEmpty())
            <div class="home-hero-section">
                <img class="home-image" src="/images/vektor_favorites.svg" alt="illustration of an women choosing between healty and unhealthy ingredients">

                <div class="home-hero-text-wrapper">
                    <div class="home-hero-section-text margin-bottom-30">
                        <p>There's nothing in your newsfeed, start exploring!</p>
                    </div>

                    <a href="{{route('recipes.index')}}">
                        <div class="cta-btn-wrapper cta-btn-small">
                            <div class="cta-btn">
                                explore
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif()

        <div class="recipe-cards-wrapper-flex">
            @foreach($recipes as $recipe)
                <div class="margin-bottom-50 recipe-element">
{{--                    <div class="recipe-card-wrapper">--}}
                        <a href="{{ route('recipes.show', $recipe->id) }}">
                            <div class="recipe-card">
                                <div>

                                    @if($recipe->image_path)
                                        <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                                    @else
                                        <img class="recipe-detail-img" src="/images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                                    @endif
                                </div>
                                <div class="recipe-card-text">
                                    <div class="rating-star-wrapper js-rating-star-wrapper">
                                        @if($recipe->rating_average >= 1)
                                            <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                        @else
                                            <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                        @endif

                                        @if($recipe->rating_average >= 2)
                                            <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                        @else
                                            <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                        @endif

                                        @if($recipe->rating_average >= 3)
                                            <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                        @else
                                            <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                        @endif

                                        @if($recipe->rating_average >= 4)
                                            <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                        @else
                                            <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                        @endif

                                        @if($recipe->rating_average >= 5)
                                            <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                        @else
                                            <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                        @endif

                                    </div>

                                    <h2>{{ $recipe->title }}</h2>
                                    <p>{{ $recipe->description }}</p>

                                    <div class="recipe-card-profile-info">
                                        @if($recipe->user->image_path)
                                            <img class="profile-image" src="/storage/images/profile_images/{{ $recipe->user->image_path }}">
                                        @else
                                            <img class="profile-image" src="/images/avatar.png" alt="Profile Image" />
                                        @endif
                                        <div>
                                            {{ $recipe->user->name }}
                                        </div>
                                    </div>

                                    <div class="recipe-created-date">
                                        {{$recipe->created_at->diffForHumans()}}
                                    </div>
                                </div>
                            </div>
                        </a>
{{--                    </div>--}}
                </div>
            @endforeach
        </div>
    </div>

@endsection
