@extends('layouts.master')

@section('title', 'Page Not Found')

@section('container')

    <div class="wrapper align-content-center">
        <div class="home-hero-section">
            <img class="home-image" src="/images/404_vektor.svg" alt="illustration for 404 error (page not found)">

            <div class="home-hero-text-wrapper">
                <div class="home-hero-section-text margin-bottom-30">
                    <p class="text-bold">Oooops..</p>
                    <p>We can't seem to find the page you are looking for. Please go back to the previous page. </p>
                </div>

                <a href="/">
                    <div class="cta-btn-wrapper cta-btn-small">
                        <div class="cta-btn">
                            home
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
