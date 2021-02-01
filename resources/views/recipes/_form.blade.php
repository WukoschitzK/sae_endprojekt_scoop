<div class="form-recipe-wrapper-input">
    <label for="input_title">Title <span class="required-star">*</span></label>
    <input type="text" name="title" value="{{ $recipe->title }}" class="form-recipe-input js-input-title" id="input_title">
    <div class="form-character-counter text-right"><span class="js-count-title">35</span> characters remaining</div>
    <div class="error">{{ $errors->first('title') }}</div>
</div>

<div class="form-recipe-wrapper-input">
    <label for="input_description">Description <span class="required-star">*</span></label>
    <textarea rows="6" cols="150" type="text" name="description" class="form-recipe-input js-input-description" id="input_description">{{ $recipe->description }}</textarea>
    <div class="form-character-counter text-right"><span class="js-count-description">150</span> characters</div>
    <div class="error">{{ $errors->first('description') }}</div>
</div>

<div class="form-recipe-wrapper-input">

    <div class="js-wrapper-ingredients-input">
        <label for="input_ingredients">Ingredients <span class="required-star">*</span></label>

        <div class="wrapper-ingredients">
            <div>
                <div class="input-width-100">
                    <input name="ingredient[]" value="{{ $recipe->ingredient }}" class="form-recipe-input margin-bottom-10" id="input_ingredients">
                </div>
                <div class="js-remove-ingredient text-right"><img class="remove-icon" src="../../images/svg/cross.svg" alt="delete icon"></div>
            </div>
            <div class="error">{{ $errors->first('ingredient.0') }}</div>


        </div>
    </div>
    <div class="add-ingredient"><img class="add-icon" src="../../images/svg/add.svg" alt="add icon"></div>
</div>

<div class="form-recipe-wrapper-input">
    <div class="js-wrapper-steps-input">
        <label for="input_steps">Steps <span class="required-star">*</span></label>
        <div class="wrapper-steps">

            <div>
                <div class="steps-count">1</div>
                <div>
                    <div class="input-width-100">
                        <textarea rows="6" cols="150" type="text" name="steps[]" value="{{ $recipe->step }}" class="form-recipe-input margin-bottom-10" id="input_steps"></textarea>
                    </div>
                    <div class="js-remove-step text-right"><img class="remove-icon" src="../../images/svg/cross.svg" alt="delete icon"></div>
                </div>
                <div class="error">{{ $errors->first('steps.0') }}</div>
            </div>

        </div>
    </div>
    <div class="add-step"><img class="add-icon" src="../../images/svg/add.svg" alt="add icon"></div>
</div>


{{--imageupload with preview--}}
<div class="text-bold">Image</div>
<div class="recipe-image-upload">
    <div class="recipe-image-edit">
        <input name="image" type="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
        <label for="imageUpload"></label>
    </div>

    <div class="recipe-image-preview">
        <div id="imagePreview" class="current-recipe-image" style="background-image: url(/images/recipe-image-placeholder.svg);">
        </div>
    </div>
</div>


<div class="form-recipe-wrapper-input">
    <div class="text-bold margin-bottom-20">Allergens</div>
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
    <div class="text-bold margin-bottom-20">Category <span class="required-star">*</span></div>
    <ul class="category-selection-wrapper">
        @foreach($categories as $category)
            <li>
                <input type="radio" name="category" value="{{$category->id}}" id="{{$category->id}}" >
                <label for="{{$category->id}}">{{$category->name}}</label>
                <div class="error">{{ $errors->first('category') }}</div>
            </li>
        @endforeach
    </ul>
</div>


<div class="form-recipe-wrapper-input">
    <div class="text-bold margin-bottom-20">Publish</div>
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
