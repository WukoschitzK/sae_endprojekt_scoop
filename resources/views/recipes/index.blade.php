@extends('layouts.master')

{{--@section('title', trans('recipes.title'))--}}

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">All Recipes</div>

        <div class="align-right">
            <a href="{{route('recipes.create')}}">
                <div class="cta-btn-wrapper cta-btn-small">
                    <div class="cta-btn">
                       new recipe!
                    </div>
                </div>
            </a>
        </div>

        <div class="filter-desktop margin-bottom-30">
            <div>
                <div class="wrapper-filter">
                    <h3>Filter <i class="fas fa-caret-down js-toggle-show-allergens"></i></h3>
                </div>
            </div>


            <div class="form-recipe-wrapper-input">
                <ul class="js-allergen-tiles-wrapper allergen-tiles-wrapper">
                    @foreach($allergens as $allergen)
                        <li class="js-allergen-tile">
                            <label for="input_allergen_{{$allergen->id}}">{{$allergen->name}} </label>
                            <input type="checkbox" name="allergens[]" value="{{$allergen->id}}" id="input_allergen_{{$allergen->id}}" class="tryAllergen">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="categories-desktop margin-bottom-30">
            <ul class="categories-wrapper">
                @foreach($categories as $category)
                <li class="category-item">
                    <input type="radio" name="category" id="input_category_{{$category->id}}" value="{{$category->id}}" class="category-radio-btn js-select-category"/>
                    <label for="input_category_{{$category->id}}">{{$category->name}}</label>
                </li>
                @endforeach
            </ul>
        </div>

        {{--        Recipe cards--}}
        <div class="recipe-cards-wrapper-flex">
                @foreach($recipes as $recipe)
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
                @endforeach
        </div>

{{--todo: paginate design--}}
{{--        {{ $recipes->links() }}--}}
    </div>

@endsection
