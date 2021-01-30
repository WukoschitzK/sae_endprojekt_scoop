@extends('layouts.master')

@section('title', 'Home')

@section('container')

    <div>

{{--            <div class="home-hero-section">--}}
{{--                <img class="home-image" src="../images/home-image.png" alt="Image of Pancakes and Donuts" />--}}

{{--                <div class="home-hero-text-wrapper">--}}
{{--                    <div class="home-hero-section-text margin-bottom-30">--}}
{{--                        <p>Be part of an <span class="text-black">awesome</span> community</p>--}}
{{--                        <p>Scoop out the latest recipes of your favorite foodie fellow.</p>--}}
{{--                    </div>--}}

{{--                    <a href="{{ route('auth.getRegistration') }}">--}}
{{--                        <div class="cta-btn-wrapper cta-btn-small">--}}
{{--                            <div class="cta-btn">--}}
{{--                               sign up--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}



{{--            new header--}}
            <div class="header-container-wrapper">


            <div class="header-container">
                <div class="home-hero-text-wrapper">
                    <div class="home-hero-section-text margin-bottom-30">
                        <p>Be part of our community</p>
                        <p>Scoop out the latest recipes of your favorite foodie fellow. Sign up <a href="{{ route('auth.getRegistration') }}">here!</a></p>
                    </div>
                </div>

                <div class="header-container-images-berries">
                    <div class="images-berries-position-rel">
                        <img class="stachelbeere-links-1" src="../images/home_header/Stachelbeere_links_1.png" alt="salad bowl">
                        <img class="stachelbeere-links-2" src="../images/home_header/Stachelbeere_links_2.png" alt="salad bowl">
                        <img class="stachelbeerebowl" src="../images/home_header/StachelbeerenBowl.png" alt="salad bowl">
                        <img class="stachelbeere-links-3" src="../images/home_header/Stachelbeere_links_2.png" alt="salad bowl">
                        <img class="zitrone" src="../images/home_header/Zitrone.png" alt="salad bowl">
                        <img class="heidelbeere-links-1" src="../images/home_header/Heidelbeere_links_1.png" alt="salad bowl">
                        <img class="heidelbeere-links-2" src="../images/home_header/Heidelbeere_links_2.png" alt="salad bowl">
                        <img class="heidelbeere-links-3 rotate-leaves-right" src="../images/home_header/Blatt_oben_rechts.png" alt="salad bowl">
                    </div>
                </div>

                <div class="header-container-images-salad">
                    <div class="images-salad-position-rel">
                        <img class="salad-bowl rotate" src="../images/home_header/Salat.png" alt="salad bowl">
                        <img class="blatt-oben-links rotate-leaves-left" src="../images/home_header/Blatt_oben_links.png" alt="salad bowl">
                        <img class="heidelbeere-rechts" src="../images/home_header/Heidelbeere_links_1.png" alt="salad bowl">
                        <img class="stachelbeere-rechts-oben" src="../images/home_header/Stachelbeere_links_2.png" alt="salad bowl">
                        <img class="stachelbeere-rechts-unten" src="../images/home_header/Stachelbeere_links_1.png" alt="salad bowl">
                        <img class="blatt-oben-rechts rotate-leaves-right" src="../images/home_header/Blatt_oben_rechts.png" alt="salad bowl">
                    </div>
                </div>


            </div>
            </div>

{{--            end new header--}}

        <div class="wrapper margin-top-30px">
            <h1 class="text-center heading-line margin-bottom-50 home-h1">How it Works</h1>

            <div>
                <ol class="home-list-how-it-works">
                    <li class="margin-bottom-50">
                        <h2>Sign up & <br/> be creative</h2>
                        <p>Create a user profile and give others a hint for your incoming recipes.</p>
                    </li>
                    <li class="margin-bottom-50">
                        <h2>Make the <br/> community alive!</h2>
                        <p>Create recipes & share it with your followers. Comment recipes …</p>
                    </li>
                    <li class="margin-bottom-50">
                        <h2>& don’t miss your <br/> besties new recipe! </h2>
                        <p>Your newsfeed will always be filled with the latest recipe-posts.</p>
                    </li>
                </ol>
            </div>
        </div>

{{--        <div class="how-it-works-video-section margin-bottom-30">--}}
{{--            {isDesktop ? <img className="how-it-works-video-placeholder-desktop" src={howItWorksVideoPlaceholderDesktop} alt="Video Placeholder" /> : <img className="how-it-works-video-placeholder" src={howItWorksVideoPlaceholder} alt="Video Placeholder" />}--}}
{{--            <img src="../images/how-it-works-video-placeholer-desktop.png" alt="Video Placeholder" class="how-it-works-video-placeholder-desktop">--}}
{{--        </div>--}}

        <div class="wrapper">

            <div class="margin-bottom-50 md-margin-bottom-80">
            <a href="{{ route('auth.getRegistration') }}">
                <div class="cta-btn-wrapper cta-btn-small text-center">
                    <div class="cta-btn">
                        sign up
                    </div>
                </div>
            </a>
            </div>

            <h2 class="text-center heading-line margin-bottom-30 md-margin-bottom-50">Highly recommended</h2>

            <div class="margin-bottom-30 recipe-cards-wrapper-flex home-recommended">
                @foreach($recipes as $recipe)
{{--                    @include('recipes._recipecard')--}}

                <div class="margin-bottom-50 recipe-element">
{{--                    <div class="recipe-card-wrapper">--}}
                        <a href="{{ route('recipes.show', $recipe->id) }}">
                            <div class="recipe-card">

                                <div>
                                    @if($recipe->image_path)
                                        <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                                    @else
                                        <img class="recipe-detail-img" src="../images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                                    @endif
                                </div>

                                <div class="recipe-card-text">
                                    <div>
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
    {{--                                    @if($recipe->description)--}}
                                        <p>{{ \Illuminate\Support\Str::limit($recipe->description, 75, $end='...') }}</p>
    {{--                                    @endif()--}}
                                    </div>

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
                                </div>
                            </div>
                        </a>
{{--                    </div>--}}
                </div>
                @endforeach
            </div>

            <a class="link" href="{{ route('recipes.index') }}">View All</a>

        </div>
    </div>

@endsection
