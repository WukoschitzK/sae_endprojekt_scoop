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
{{--        @foreach($recipe->ingredients as $ingredient)--}}
            <div class="wrapper-ingredients">
                <label for="input_ingredient">Ingredients:</label>
                <input name="ingredient[]" value="{{ $recipe->ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredient">
            </div>
{{--        @endforeach--}}
    </div>
    <div class="text-right add-ingredient">+</div>
</div>


<div class="form-recipe-wrapper-input">
    <div class="js-wrapper-steps-input">
        <div class="wrapper-steps">
            <label for="input_steps">Steps:</label>
            <div class="steps-count">1</div>
            <input rows="6" cols="150" name="steps[]" value="{{ $recipe->steps }}" class="form-recipe-input margin-bottom-10" id="input_steps">
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
        @foreach($allergens as $allergen)
            <li class="js-allergen-tile">
                {{--                                <input type="checkbox" value="">--}}
                <label for="input_">{{$allergen->name}}</label>
                <input type="checkbox" name="input_vegan" value="{{$allergen->id}}" id="input_vegan">

            </li>
        @endforeach
    </ul>
</div>

<div class="form-recipe-wrapper-input">
    <div class="text-bold margin-bottom-10">Categories</div>
    <ul class="allergen-tiles-wrapper">
        @foreach($categories as $category)
            <li class="js-allergen-tile">
                {{--                                <input type="checkbox" value="">--}}
                {{$category->name}}
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
