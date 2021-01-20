@extends('layouts.master')

{{--@section('title', trans('recipes.title'))--}}

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">My Recipes</div>



        @if($recipes->isEmpty())
            <div class="home-hero-section">
                <img class="home-image" src="/images/vektor_no_recipes_yet.svg" alt="illustration of an women choosing between healty and unhealthy ingredients">

                <div class="home-hero-text-wrapper">
                    <div class="home-hero-section-text margin-bottom-30">
                        <p>There are no recipes yet.</p>
                    </div>

                    <a href="{{route('recipes.create')}}">
                        <div class="cta-btn-wrapper cta-btn-small">
                            <div class="cta-btn">
                                new recipe
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        @else
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
                                </div>


                            </div>
                        </a>
{{--                    </div>--}}
                </div>
            @endforeach
        </div>
        @endif()
    </div>

@endsection
