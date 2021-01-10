@extends('layouts.master')

@section('title', 'Welcome')

@section('container')

    <div>
        <div class="wrapper margin-top-30px">
            <div class="home-hero-section">
                <img class="home-image" src="../images/home-image.png" alt="Image of Pancakes and Donuts" />

                <div class="home-hero-text-wrapper">
                    <div class="home-hero-section-text margin-bottom-30">
                        <p>Be part of an <span class="text-black">awesome</span> community</p>
                        <p>Scoop out the latest recipes of your favorite foodie fellow.</p>
                    </div>

                    <a href="{{ route('auth.getRegistration') }}">
                        <div class="cta-btn-wrapper cta-btn-small">
                            <div class="cta-btn">
                               sign up
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <h1 class="text-center heading-line margin-bottom-30 home-h1">How it Works</h1>

            <div>
                <ol class="home-list-how-it-works">
                    <li class="margin-bottom-30">
                        <h2>Sign up & <br/> be creative</h2>
                        <p>Create a user profile and give others a hint for your incoming recipes.</p>
                    </li>
                    <li class="margin-bottom-30">
                        <h2>Make the <br/> community alive!</h2>
                        <p>Create recipes & share it with your followers. Comment recipes …</p>
                    </li>
                    <li class="margin-bottom-30">
                        <h2>& don’t miss your <br/> besties new recipe! </h2>
                        <p>Your newsfeed will always be filled with the latest recipe-posts.</p>
                    </li>
                </ol>
            </div>
        </div>

        <div class="how-it-works-video-section margin-bottom-30">
{{--            {isDesktop ? <img className="how-it-works-video-placeholder-desktop" src={howItWorksVideoPlaceholderDesktop} alt="Video Placeholder" /> : <img className="how-it-works-video-placeholder" src={howItWorksVideoPlaceholder} alt="Video Placeholder" />}--}}
            <img src="../images/how-it-works-video-placeholer-desktop.png" alt="Video Placeholder" class="how-it-works-video-placeholder-desktop">
        </div>

        <div class="wrapper">

            <div class="margin-bottom-50 md-margin-bottom-80">
            <a href="{{ route('auth.getRegistration') }}">
                <div class="cta-btn-wrapper cta-btn-small">
                    <div class="cta-btn">
                        sign up
                    </div>
                </div>
            </a>
            </div>

            <h2 class="text-center heading-line margin-bottom-30">Highly recommended</h2>

            <div class="margin-bottom-30 recipe-cards-wrapper-flex home-recommended">
                @foreach($recipes as $recipe)

                <div class="margin-bottom-50 recipe-element">
                    <div class="recipe-card-wrapper">
                        <div class="recipe-card">
                            <a href="{{ route('recipes.show', $recipe->id) }}">
                                @if($recipe->image_path)
                                    <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                                @else
                                    <img class="recipe-detail-img" src="/images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                                @endif

                                <div class="recipe-card-text">

                                    <h2>{{$recipe->title}}</h2>
                                    <p>{{$recipe->description}}</p>

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
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

<a class="link" href="{{ route('recipes.index') }}">View All</a>

        </div>
    </div>

@endsection
