@extends('layouts.master')

{{--@section('title', $user->name)--}}

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">Following</div>

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
