@extends('layouts.master')

{{--@section('title', $user->name)--}}

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

        <div class="h1 heading-line d-inline-block">Following</div>

        @if($followings->isEmpty())
            <div class="home-hero-section">
                <img class="home-image" src="/images/vektor_follow.svg" alt="illustration of an women choosing between healty and unhealthy ingredients">

                <div class="home-hero-text-wrapper">
                    <div class="home-hero-section-text margin-bottom-30">
                        <p>There are no recipes yet.</p>
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

        <ul class="following-list-flex">

                @foreach($followings as $following)
                <li class="margin-bottom-30">
                    <div class="following-list-wrapper">
                        <a href="{{ url('/user-profile/' . $following->id)}}">
                            <div class="following-list-profile-wrapper">
                                @if($following->image_path)
                                    <img class="profile-image following-list" src="/storage/images/profile_images/{{ $following->image_path }}">
                                @else
                                    <img class="profile-image following-list" src="/images/profile-image-placeholder.jpg" alt="Profile Image" />
                                @endif
                                <div>
                                    <div>{{$following->name}}</div>
                                    <div class="font-14-px">{{$following->recipes->count()}} Recipes</div>
                                </div>
                            </div>
                        </a>

                        <form method="post" action="{{ route('profile.unfollow', $following->id) }}" autocomplete="off")">
                            @csrf
                            <div class="margin-bottom-50 cta-btn-right cta-btn-unfollow">
                                <div class="cta-btn-wrapper-sm">
                                    <div class="cta-btn-sm">
                                        <button type="unfollow" class="btn btn-warning mt-2">
                                            unfollow
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                @endforeach
        </ul>
    </div>

@endsection
