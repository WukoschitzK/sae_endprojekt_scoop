@extends('layouts.master')

@section('title', $recipe->title)

@section('container')

    <div>
        @if(Session::has('success'))
            <div class="notification-container">
                <div class="notification-background">
                    <div class="notification-text">

                        <p class="success">{{ Session::get('success') }}</p>

                    </div>
                </div>
            </div>
        @endif

        {{--desktop--}}
        <div class="recipe-detail-wrapper margin-bottom-50">
            <div class="recipe-detail-wrapper-flex">

                @if($recipe->image_path)
                    <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                @else
                    <img class="recipe-detail-img" src="../images/recipe-image-placeholder.svg" alt="Placeholderimage of Recipe" />
                @endif
                <div class="recipe-detail-text wrapper">

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


                    @if($isAuthUser == true)
                        <div class="text-right">
                            <a href="{{ url('recipes/' . $recipe->id . '/edit') }}" class="font-14-px">
                            Edit Recipe</a>
                        </div>
                    @endif

                    <div class="recipe-detail-cta-favorite text-right">
                        @if(auth()->check())
                            @if(Auth::user()->favoriteRecipe()->where('id', '=', $recipe->id)->count() > 0)
                                <form method="post" action="{{ route('recipes.removeFavorite', $recipe->id) }}" autocomplete="off">
                                    @csrf

                                    <button type="submit" class="btn btn-info mt-2 no-btn-style">
                                        <img src="/images/svg/heart_filled.svg" alt="heart icon for remove the recipe from favorites"/>
                                    </button>

                                </form>
                            @else()
                                <form method="post" action="{{ route('recipes.addFavorite', $recipe->id) }}" autocomplete="off">
                                    @csrf

                                    <button type="submit" class="add-favorite-btn no-btn-style">

                                        <img src="/images/svg/heart.svg" alt="heart icon for remove the recipe from favorites"/>
                                    </button>

                                </form>
                            @endif
                        @endif
                    </div>

                    <div class="recipe-detail-text-section">
                        <div class="h1 heading-line d-inline-block">
                            {{ $recipe->title }}
                        </div>
                        <p class="margin-bottom-30">
                            {{ $recipe->description }}
                        </p>
                    </div>

                    <div class="recipe-detail-text-user">
                        <a href="{{ url('/user-profile/' . $user->id)}}">
                            <div class="recipe-card-profile-info">

                                @if($user->image_path)
                                    <img class="profile-image" alt="Profile Image" src="/storage/images/profile_images/{{ $user->image_path }}">
                                @else
                                    <img class="profile-image" src="../images/avatar.png" alt="Profile Image" />
                                @endif

                                <div class="font-14-px">{{ $user->name }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper wrapper-recipe-show">
            {{--start desktop--}}
            <div class="recipe-detail-ingredient-step-flex margin-bottom-50 desktop-ingr-steps">
                <div class="recipe-detail-ingredient-step-item">
                    <h2 class="heading-line d-inline-block">
                        Ingredients
                    </h2>
                    <ul class="ingredients-list">
                        @foreach($recipe->ingredients as $ingredient)
                            <li class="ingredients-list-item">
                                {{ $ingredient }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="recipe-detail-ingredient-step-item">
                    <h2 class="heading-line d-inline-block">
                        Steps
                    </h2>
                    <ol class="steps-list">
                        @foreach($recipe->steps as $step)
                            <li class="step-list-item margin-bottom-30">
                                <div class="steps-count">{{ $loop->iteration}}</div>
                                <p>{{ $step }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            {{--desktop end--}}

            {{--start mobile--}}
            <div class="mobile-ingr-steps">
                <ul class="recipe-tabs margin-bottom-30">
                    <li class="recipe-tab-active" id="js-tab-ingr">Ingredients</li>
                    <li class="" id="js-tab-steps">Steps</li>
                </ul>

                <div class="margin-bottom-30">
                    <ul class="ingredients-list js-list-ingr">
                        @foreach($recipe->ingredients as $ingredient)
                            <li class="ingredients-list-item">
                                {{ $ingredient }}
                            </li>
                        @endforeach
                    </ul>



                    <ol class="steps-list js-list-steps">
                        @foreach($recipe->steps as $step)
                            <li class="step-list-item margin-bottom-30">
                                <div class="steps-count">{{ $loop->iteration}}</div>
                                <p>{{ $step }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            {{--mobile end--}}

            <div class="margin-bottom-50">
                <h2>Allergens</h2>

                <div class="form-recipe-wrapper-input">
                    <ul class="allergen-tiles-wrapper">
                        @foreach($allergens as $allergen)
                            <li class="active">
                                <div>{{ $allergen->name }}</div>
                            </li>
                        @endforeach
                        @foreach($allAllergens as $allAllergen)
                                <li>
                                    {{ $allAllergen->name }}
                                </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="margin-bottom-50">
                <h2 class="margin-bottom-30">Rate & leave a Reply</h2>
                <div class="txt-center">
                    <form class="form-comment" action="{{route('recipes.postReview', $recipe->id)}}" method="post">
                        @csrf
                        <div class="rating margin-bottom-20">
                            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                            <label for="star5">☆</label>
                            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                            <label for="star4" >☆</label>
                            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                            <label for="star3" >☆</label>
                            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                            <label for="star2" >☆</label>
                            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                            <label for="star1" >☆</label>
                        </div>

                        <div class="margin-bottom-30">
                            <label for="input_comment">Comment:</label>
                            <textarea rows="6" cols="150" class="form-recipe-input" name="comment" id="input_comment"></textarea>
                        </div>

                        <div class="cta-btn-wrapper cta-btn-small margin-bottom-50">
                            <div class="cta-btn">
                                <button type="submit">
                                    save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="margin-bottom-50">
                <h2 class="margin-bottom-30">Comments</h2>
                <div class="comments-flex-wrap">

                    @foreach($reviews as $review)
                    <div class="comment-wrapper">
                        <div class="margin-bottom-20">
                            <a href="{{ url('/user-profile/' . $review->user_id)}}">
                                <div class="recipe-card-profile-info">

                                    @if($review->user->image_path != null)
                                        <img class="profile-image" alt="Profile Image" src="/storage/images/profile_images/{{ $review->user->image_path }}">
                                    @else
                                        <img class="profile-image" src="/images/avatar.png" alt="Profile Image" />
                                    @endif

                                    <div class="font-14-px">{{ $review->user->name }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="rating-star-wrapper margin-bottom-10">
                                @if($review->rating >= 1)
                                    <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                @else
                                    <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                @endif

                                @if($review->rating >= 2)
                                    <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                @else
                                    <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                @endif

                                @if($review->rating >= 3)
                                    <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                @else
                                    <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                @endif

                                @if($review->rating >= 4)
                                    <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                @else
                                    <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                @endif

                                @if($review->rating >= 5)
                                    <img class="rating-star filled" src="/images/svg/rating-star-filled.svg" alt="rating star">
                                @else
                                    <img class="rating-star" src="/images/svg/rating-star-unfilled.svg" alt="rating star">
                                @endif
                        </div>

                        <p>{{$review->comment}}</p>
                    </div>
                    @endforeach()

                    @if($reviews->isEmpty())
                        <p>There are no comments yet.</p>
                    @endif()

                </div>
            </div>
        </div>
    </div>

@endsection
