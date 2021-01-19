<div class="form-recipe-wrapper-input">
    <label for="input_title">Title:</label>
    <input type="text" name="title" value="{{ $recipe->title }}" class="form-recipe-input js-input-title" id="input_title">
    <div class="form-character-counter text-right"><span class="js-count-title">35</span> characters remaining</div>
</div>

<div class="form-recipe-wrapper-input">
    <label for="input_description">Description:</label>
    <textarea rows="6" cols="150" type="text" name="description" class="form-recipe-input js-input-description" id="input_description">{{ $recipe->description }}</textarea>
    <div class="form-character-counter text-right"><span class="js-count-description">150</span> characters</div>
</div>

<div class="form-recipe-wrapper-input">
    <div class="js-wrapper-ingredients-input">
        <div class="wrapper-ingredients">
            <label for="input_ingredient">Ingredients:</label>
            <input name="ingredient[]" value="{{ $recipe->ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredient">
        </div>
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
                <label for="input_allergen_{{$allergen->id}}">{{$allergen->name}}</label>
                <input type="checkbox" name="allergens[]" value="{{$allergen->id}}" id="input_allergen_{{$allergen->id}}" class="tryAllergen">
            </li>
        @endforeach
    </ul>
</div>

<div class="form-recipe-wrapper-input">
    <div class="text-bold margin-bottom-10">Categories</div>
    <ul class="category-selection-wrapper">
        @foreach($categories as $category)
            <div>
                <input type="radio" name="category" value="{{$category->id}}" id="{{$category->id}}" >
                <label for="{{$category->id}}">{{$category->name}}</label>
            </div>
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
            save
        </button>
    </div>
</div>
