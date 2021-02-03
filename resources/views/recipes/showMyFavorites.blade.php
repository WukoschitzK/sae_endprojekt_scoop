@extends('layouts.master')

@section('title', 'Favorites')

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">My Favorites</div>

        @if($recipes->isEmpty())
            <div class="empty-section">
                <img src="/images/vektor_favorite_recipes.svg" alt="illustration of an women choosing between healty and unhealthy ingredients">

                <div class="empty-section-text-wrapper">
                    <div class="empty-section-text margin-bottom-30">
                        <p>You have no favorites saved, start exploring!</p>
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
                                    <p>{{ $recipe->description }}</p>
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
                </div>
            @endforeach
        </div>
    </div>

@endsection
