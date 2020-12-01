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
                        <div class="cta-btn-wrapper">
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
                <div class="cta-btn-wrapper">
                    <div class="cta-btn">
                        sign up
                    </div>
                </div>
            </a>
            </div>

{{--            <Link to="/sign-up">--}}
{{--            <div className="margin-bottom-50 md-margin-bottom-80">--}}
{{--                <CtaButton name="get started!"/>--}}
{{--            </div>--}}
{{--            </Link>--}}

            <h2 class="text-center heading-line margin-bottom-30">Highly recommended</h2>



            <div class="margin-bottom-30 recipe-cards-wrapper-flex home-recommended">
                <div class="margin-bottom-50 recipe-element">
{{--                    <RecipeCard />--}}
                </div>
                <div class="margin-bottom-50 recipe-element">
{{--                    <RecipeCard />--}}
                </div>
                <div class="margin-bottom-50 recipe-element">
{{--                    <RecipeCard />--}}
                </div>
            </div>



<a class="link" href="{{ route('recipes.index') }}">View All</a>

        </div>
    </div>

@endsection
