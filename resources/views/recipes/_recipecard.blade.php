@extends('layouts.master')

{{--@section('title', trans('recipes.title'))--}}

@section('container')

    <div class="margin-bottom-50 recipe-element">
        <div class="recipe-card-wrapper">
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

{{--                                            todo: cannot show user?--}}
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
        </div>
    </div>

@endsection
