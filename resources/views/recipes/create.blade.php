@extends('layouts.master')

@section('title', 'New Recipe')

@section('container')

    <div class="wrapper">

        <div class="h1 heading-line d-inline-block">New Recipe</div>


        <form class="form-recipe" method="post" action="{{ route('recipes.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf

            @include('recipes._form')

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                    <label for="input_title">Title:</label>--}}
{{--                    <input type="text" name="title" value="{{ $recipe->title }}" class="form-recipe-input" id="input_title">--}}
{{--                <div class="form-character-counter text-right">max 35 characters</div>--}}
{{--            </div>--}}

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <label for="input_description">Description:</label>--}}
{{--                <textarea rows="6" cols="150" type="text" name="description" class="form-recipe-input" id="input_description">{{ $recipe->description }}</textarea>--}}
{{--                <div class="form-character-counter text-right">max 150 characters</div>--}}
{{--            </div>--}}

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <label for="input_ingredients">Ingredients:</label>--}}
{{--                <input name="ingredients" value="{{ $recipe->ingredients }}" class="form-recipe-input margin-bottom-10" id="input_ingredients">--}}
{{--                <div class="text-right add-step">+</div>--}}
{{--            </div>--}}

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <label for="input_steps">Steps:</label>--}}
{{--                <div class="steps-count">1</div>--}}
{{--                <input rows="6" cols="150" name="steps" value="{{ $recipe->steps }}" class="form-recipe-input margin-bottom-10" id="input_steps">--}}
{{--                <div class="text-right add-step">+</div>--}}
{{--            </div>--}}


{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <label for="input_image" class="text-bold margin-bottom-10">Images</label>--}}
{{--                <input type="file" name="image" class="form-control" id="input_image">--}}
{{--                <div>+ Add Images</div>--}}
{{--            </div>--}}

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <div class="text-bold margin-bottom-10">Allergens</div>--}}
{{--                    <ul class="allergen-tiles-wrapper">--}}
{{--                        @foreach($allergens as $allergen)--}}
{{--                            <li class="js-allergen-tile">--}}
{{--                                <input type="checkbox" value="">--}}
{{--                                {{$allergen->name}}--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--            </div>--}}

{{--            <div class="form-recipe-wrapper-input">--}}
{{--                <div class="text-bold margin-bottom-10">Publish</div>--}}
{{--                <div>--}}
{{--                    <input type="checkbox" name="is_public" id="input_featured" {{ $recipe->is_public ? 'checked' : '' }}>--}}
{{--                    <label for="input_public" class="padding-left-10 publish">Make it publish</label>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="cta-btn-wrapper margin-bottom-50">--}}
{{--                <div class="cta-btn">--}}
{{--                    <button type="submit">--}}
{{--                        Save--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </form>
    </div>

@endsection
