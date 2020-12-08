@extends('layouts.master')

{{--@section('title', $recipe->title)--}}

@section('container')

{{--	<div class="card mt-4">--}}
{{--		<div class="card-body">--}}



{{--			<h2>{{ $recipe->title }}</h2>--}}

{{--			@if($recipe->is_public)--}}
{{--				<div class="alert alert-info">public!</div>--}}
{{--			@endif--}}

{{--			@if($recipe->ingredients)--}}
{{--				<p>{{ $recipe->ingredients }}</p>--}}
{{--			@endif--}}

{{--            @if($recipe->steps)--}}
{{--                <p>{{ $recipe->steps }}</p>--}}
{{--            @endif--}}

{{--			@if($recipe->image_path)--}}
{{--				<img class="w-50" src="{{ $recipe->image_url }}">--}}
{{--			@endif--}}


{{--            <a href="{{ url('/user-profile/' . $user->id)}}"><p>User: {{ $user->name }}</p></a>--}}

{{--			<p>{{ nice_date($recipe->created_at) }}</p>--}}

{{--			<a href="{{ route('recipes.index') }}" class="btn btn-outline-primary">--}}
{{--				<i class="fa fa-chevron-left"></i> Back--}}
{{--			</a>--}}

{{--			<a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">--}}
{{--				<i class="fa fa-pencil"></i> Edit--}}
{{--			</a>--}}

{{--			<form method="post" action="{{ route('recipes.destroy', $recipe->id) }}" autocomplete="off" onsubmit="return confirm('Are you sure?')">--}}

{{--				@method('delete')--}}
{{--				@csrf--}}

{{--				<button type="submit" class="btn btn-outline-danger mt-2">--}}
{{--					<i class="fa fa-trash"></i> Delete--}}
{{--				</button>--}}

{{--			</form>--}}

{{--		</div>--}}
{{--	</div>--}}




    <div>
        {{--desktop--}}
        <div class="recipe-detail-wrapper margin-bottom-50">
            <div class="recipe-detail-wrapper-flex">


                @if($recipe->image_path)
                    <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                @else
                    <img class="recipe-detail-img" src="../images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                @endif
                <div class="recipe-detail-text">
                    <div class="rating-stars">

                    </div>

                    @if($recipe->user_id == auth()->user()->id)
                        <div>
                            <a href="{{ url('recipes/' . $recipe->id . '/edit') }}">
                            Edit Recipe</a>
                        </div>
                    @endif

{{--                    addforivite--}}
                    <form method="post" action="{{ route('recipes.addFavorite', $recipe->id) }}" autocomplete="off">
                    @csrf

                    <button type="submit" class="btn btn-info mt-2">
                        add favorite
                    </button>

                    </form>
                    {{--                    removeFavorite--}}
                    <form method="post" action="{{ route('recipes.removeFavorite', $recipe->id) }}" autocomplete="off">
                        @csrf

                        <button type="submit" class="btn btn-info mt-2">
                            remove favorite
                        </button>

                    </form>

                    <div class="recipe-detail-text-section">
                        <div class="h1">
                            {{ $recipe->title }}
                        </div>
                        <p class="margin-bottom-30">
                            {{ $recipe->description }}
                        </p>
                    </div>


{{--                    <div class="form-recipe-wrapper-input">--}}
{{--                        <div class="js-wrapper-ingredients-input">--}}
{{--                            @foreach($recipe->ingredients as $ingredient)--}}
{{--                                <div class="wrapper-ingredients">--}}
{{--                                    <label for="input_ingredients">Ingredients:</label>--}}
{{--                                    <input name="ingredients" value="{{ $ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredients">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-recipe-wrapper-input">--}}
{{--                        <div class="js-wrapper-steps-input">--}}
{{--                            @foreach($recipe->steps as $step)--}}
{{--                                <div class="wrapper-steps">--}}
{{--                                    <label for="input_steps">Steps:</label>--}}
{{--                                    <input name="steps" value="{{ $step }}" class="form-recipe-input margin-bottom-10" id="input_steps">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    @foreach($recipe->ingredients as $ingredient)--}}
{{--                        <div class="wrapper-ingredients">--}}
{{--                            <label for="input_ingredients">Ingredients:</label>--}}
{{--                            <input name="ingredients" value="{{ $ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredients">--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                    @foreach($recipe->steps as $step)--}}
{{--                        <div class="wrapper-steps">--}}
{{--                            <label for="input_steps">Steps:</label>--}}
{{--                            <input name="steps" value="{{ $step }}" class="form-recipe-input margin-bottom-10" id="input_steps">--}}
{{--                        </div>--}}
{{--                    @endforeach--}}


                    <div>
                        <a href="{{ url('/user-profile/' . $user->id)}}">
                            <div class="recipe-card-profile-info">

                                @if($user->image_url)
                                    <img class="profile-image" alt="Profile Image" src="{{ $user->image_url }}">
                                @else
                                    <img class="profile-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />
                                @endif

                                <div class="font-14-px">{{ $user->name }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <div class="recipe-detail-ingredient-step-flex margin-bottom-50">
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
                            <div class="steps-count">{{ $loop->iteration}}</div>
                            <p>{{ $step }}</p>
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="width-50 margin-bottom-50">
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
                                        <div>{{ $allAllergen->name }}</div>
                                    </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <div class="width-50 margin-bottom-50">
                <h2 class="margin-bottom-30">Comments</h2>
                {{--                <AllergenTiles />--}}
            </div>

            <div class="comments-flex-wrap">
                <div class="comment-wrapper">
                    <div class="margin-bottom-20">
                        <a href="{{ url('/user-profile/' . $user->id)}}">
                            <div class="recipe-card-profile-info">

                                @if($user->image_url)
                                    <img class="profile-image" alt="Profile Image" src="{{ $user->image_url }}">
                                @else
                                    <img class="profile-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />
                                @endif

                                <div class="font-14-px">{{ $user->name }}</div>
                            </div>
                        </a>
                    </div>

                    <div class="rating-stars margin-bottom-10">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p>Absolutely the BEST meatloaf I’ve ever had!!! My son mentioned that he thought it was better than what my mom used to make. No more searching for a good recipe cause I found the best.</p>
                </div>

                <div class="comment-wrapper">

                    <div class="margin-bottom-20">
                        <a href="{{ url('/user-profile/' . $user->id)}}">
                            <div class="recipe-card-profile-info">

                                @if($user->image_url)
                                    <img class="profile-image" alt="Profile Image" src="{{ $user->image_url }}">
                                @else
                                    <img class="profile-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />
                                @endif

                                <div class="font-14-px">{{ $user->name }}</div>
                            </div>
                        </a>
                    </div>

                    <div class="rating-stars margin-bottom-10">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <p>Absolutely the BEST meatloaf I’ve ever had!!! My son mentioned that he thought it was better than what my mom used to make. No more searching for a good recipe cause I found the best.</p>
                </div>
            </div>
        </div>

        {{--end desktop--}}


        {{--mobile--}}

{{--        <div class="wrapper">--}}
{{--            <div class="margin-bottom-20">--}}
{{--                <div>--}}
{{--                    <a href="{{ url('/user-profile/' . $user->id)}}">--}}
{{--                        <div class="recipe-card-profile-info">--}}

{{--                            @if($user->image_url)--}}
{{--                                <img class="profile-image" alt="Profile Image" src="{{ $user->image_url }}">--}}
{{--                            @else--}}
{{--                                <img class="profile-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />--}}
{{--                            @endif--}}
{{--                            <div class="font-14-px">{{$user->name}}</div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="h1 heading-line d-inline-block">English Meatloaf</div>--}}

{{--            <p>Candy chups apple pie b canes chupa chups apple pie biscuit chups apple pie b canes chupa chups apple pie biscuit.</p>--}}
{{--        </div>--}}

{{--        @if($recipe->image_path)--}}
{{--            <img class="recipe-image" src="{{ $recipe->image_url }}" alt="Picture of Recipe" />--}}
{{--        @else--}}
{{--            <img class="recipe-image" src="../images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />--}}
{{--        @endif--}}

{{--        <div class="wrapper">--}}
{{--            <ul class="recipe-tabs margin-bottom-30">--}}
{{--                <li class="recipe-tab-active">Ingredients</li>--}}
{{--                <li class="">Steps</li>--}}
{{--            </ul>--}}

{{--            <div class="margin-bottom-30">--}}
{{--                <ul class="ingredients-list">--}}
{{--                    <li class="ingredients-list-item">250gr Flour</li>--}}
{{--                    <li class="ingredients-list-item">2 large carrots</li>--}}
{{--                    <li class="ingredients-list-item">400g can chopped tomatoes</li>--}}
{{--                    <li class="ingredients-list-item">410g can green lentils</li>--}}
{{--                    <li class="ingredients-list-item">85g vegetarian mature cheddar</li>--}}
{{--                    <li class="ingredients-list-item">1 tbsp olive oil</li>--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            <div class="margin-bottom-30">--}}
{{--                <ol class="steps-list">--}}
{{--                    <li class="step-list-item margin-bottom-30">--}}
{{--                        <div class="steps-count">1</div>--}}
{{--                        <p>Put all the wet ingredients into a bowl.</p>--}}
{{--                    </li><li class="step-list-item margin-bottom-30">--}}
{{--                        <div class="steps-count">2</div>--}}
{{--                        <p>In a large bowl, add the beef, bread crumbs, onion, milk, egg, 2 tablespoons ketchup, worcestershire sauce, parsley, salt, garlic powder, and pepper. Use your hands to mush and mix these ingredients together until well combined.</p>--}}
{{--                    </li>--}}
{{--                    <li class="step-list-item margin-bottom-30">--}}
{{--                        <div class="steps-count">3</div>--}}
{{--                        <p>Add the meat mixture to a loaf pan. Pat the meat down into an even layer.</p>--}}
{{--                    </li>--}}
{{--                    <li class="step-list-item margin-bottom-30">--}}
{{--                        <div class="steps-count">4</div>--}}
{{--                        <p>In a small bowl, add 1/4 cup ketchup, the brown sugar, and vinegar. Stir to combine. Pour the sauce on top of the meatloaf and spread it into an even layer.</p>--}}
{{--                    </li>--}}
{{--                    <li class="step-list-item margin-bottom-30">--}}
{{--                        <div class="steps-count">5</div>--}}
{{--                        <p>Bake uncovered for 55 minutes.  Let the meatloaf rest for 8-10 minutes before serving (or it may fall apart).</p>--}}
{{--                    </li>--}}
{{--                </ol>--}}
{{--            </div>--}}

{{--            <div class="margin-bottom-30">--}}
{{--                <h2>Allergens</h2>--}}
{{--                <div>--}}
{{--                    <ul class="allergen-tiles-wrapper">--}}
{{--                        <li class="">gluten-free</li>--}}
{{--                        <li class="">histamine-free</li>--}}
{{--                        <li class="">vegan</li>--}}
{{--                        <li class="">vegetarian</li>--}}
{{--                        <li class="">nut-free</li>--}}
{{--                        <li class="">lactose-free</li>--}}
{{--                        <li class="">undefined</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="margin-bottom-30">--}}
{{--                <h2>Leave a Reply</h2>--}}
{{--                <div>--}}
{{--                    <form class="form-recipe">--}}
{{--                        <div class="rating-wrapper-flex margin-bottom-20">--}}
{{--                            <div>Recipe Rating</div>--}}
{{--                            <div class="rating-stars">--}}
{{--                                <i class="fas fa-star"></i>--}}
{{--                                <i class="fas fa-star"></i>--}}
{{--                                <i class="fas fa-star"></i>--}}
{{--                                <i class="fas fa-star"></i>--}}
{{--                                <i class="fas fa-star"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="margin-bottom-20">--}}
{{--                            <label>Comment</label>--}}
{{--                            <textarea rows="6" cols="150" type="text" class="form-recipe-input"></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="margin-bottom-50">--}}
{{--                            <div class="cta-btn-wrapper">--}}
{{--                                <div class="cta-btn">save</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="margin-bottom-30">--}}
{{--                <h2>Comments</h2>--}}
{{--                <div>--}}
{{--                    <div class="comment-wrapper">--}}
{{--                        <div>--}}
{{--                            <a href="{{ url('/user-profile/' . $user->id)}}">--}}
{{--                                <div class="recipe-card-profile-info">--}}
{{--                                    @if($user->image_url)--}}
{{--                                        <img class="profile-image" alt="Profile Image" src="{{ $user->image_url }}">--}}
{{--                                    @else--}}
{{--                                        <img class="profile-image" src="../images/profile-image-placeholder.jpg" alt="Profile Image" />--}}
{{--                                    @endif--}}

{{--                                    <div class="font-14-px">--}}
{{--                                        {{$user->name}}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="rating-stars margin-bottom-10">--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                            <i class="fas fa-star"></i>--}}
{{--                        </div>--}}
{{--                        <p>Absolutely the BEST meatloaf I’ve ever had!!! My son mentioned that he thought it was better than what my mom used to make. No more searching for a good recipe cause I found the best.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{--end mobile--}}

    </div>

@endsection
