@extends('layouts.master')

@section('title', 'Edit')

@section('container')

    <div class="wrapper">
        <form method="post" action="{{ route('recipes.destroy', $recipe->id) }}" enctype="multipart/form-data">
            @method('delete')
            @csrf

            <button type="submit">delete</button>
        </form>

        <div class="h1 heading-line d-inline-block">Edit Recipe</div>
        <form class="form-recipe" method="post" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data" autocomplete="off">

            @method('put')
            @csrf

            <div class="form-recipe-wrapper-input">
                <label for="input_title">Title:</label>
                <input type="text" name="title" value="{{ $recipe->title }}" class="form-recipe-input" id="input_title">
                <div class="form-character-counter text-right">max 35 characters</div>
            </div>

            <div class="form-recipe-wrapper-input">
                <label for="input_description">Description:</label>
                <textarea rows="6" cols="150" type="text" name="description" class="form-recipe-input" id="input_description">{{ $recipe->description }}</textarea>
                <div class="form-character-counter text-right">max 150 characters</div>
            </div>

            <div class="form-recipe-wrapper-input">
                <div class="js-wrapper-ingredients-input">
                    <div class="wrapper-ingredients">
                        <label for="input_ingredients">Ingredients:</label>
                        @foreach($recipe->ingredients as $ingredient)
                            <div>
                                <input name="ingredient[]" value="{{ $ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredients">
                                <div class="js-remove-ingredient">X</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-right add-ingredient">+</div>
            </div>


            <div class="form-recipe-wrapper-input">
                <div class="js-wrapper-steps-input">
                    <div class="wrapper-steps">
                        <label for="input_steps">Steps:</label>
                    @foreach($recipe->steps as $step)
{{--                        todo: count icons--}}
{{--                                <div class="steps-count">1</div>--}}
                        <div>
                            <input name="steps[]" value="{{ $step }}" class="form-recipe-input margin-bottom-10" id="input_steps">
                            <div class="js-remove-step">X</div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="text-right add-step">+</div>
            </div>


            <div class="form-recipe-wrapper-input">
                <label for="input_image" class="text-bold margin-bottom-10">Images</label>
                <input type="file" name="image" class="form-control" id="input_image">
                <div>+ Add Images</div>
            </div>

            <div class="form-recipe-wrapper-input">
                <div class="text-bold margin-bottom-10">Allergens</div>
                <ul class="allergen-tiles-wrapper">
                    <div class="form-recipe-wrapper-input">
                        <ul class="allergen-tiles-wrapper">
                            @foreach($allergens as $allergen)
                                <li class="active">
                                    <label for="input_allergen_{{$allergen->id}}">{{$allergen->name}}</label>
                                    <input type="checkbox" name="allergens[]" value="{{$allergen->id}}" id="input_allergen_{{$allergen->id}}" class="allergen-btn-editform" checked>
                                </li>
                            @endforeach
                            @foreach($allAllergens as $allAllergen)
                                <li>
                                    <label for="input_allergen_{{$allAllergen->id}}">{{$allAllergen->name}}</label>
                                    <input type="checkbox" name="allergens[]" value="{{$allAllergen->id}}" id="input_allergen_{{$allAllergen->id}}" class="allergen-btn-editform">
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </ul>
            </div>

            <div class="form-recipe-wrapper-input">
                <div class="text-bold margin-bottom-10">Categories</div>
                <ul class="allergen-tiles-wrapper">
                    @foreach($categories as $category)
                        <li>
                            <label for="{{$category->id}}">{{$category->name}}</label>
                            <input type="radio" name="category" value="{{$category->id}}" id="{{$category->id}}" {{ $recipe->category_id == $category->id ? "checked" : "" }}>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-recipe-wrapper-input">
                <div class="text-bold margin-bottom-10">Publish</div>
                <div>
                    <input type="checkbox" name="is_public" id="input_featured" {{ $recipe->is_public ? 'checked' : '' }}>
                    <label for="input_public" class="padding-left-10 publish">Make it publish</label>
                </div>
            </div>

            <div class="cta-btn-wrapper margin-bottom-50">
                <div class="cta-btn">
                    <button type="submit">
                        Save
                    </button>
                </div>
            </div>

        </form>
	</div>

@endsection
