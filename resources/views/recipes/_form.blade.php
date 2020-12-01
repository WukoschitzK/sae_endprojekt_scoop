
<div class="form-group">
	<label for="input_title">Title:</label>
	<input type="text" name="title" value="{{ $recipe->title }}" class="form-control" id="input_title">
</div>

<div class="form-group">
    <label for="input_description">Description:</label>
    <input type="text" name="description" value="{{ $recipe->description }}" class="form-control" id="input_description">
</div>

<div class="form-group">
    <label for="input_ingredients">Ingredients:</label>
    <textarea name="ingredients" class="form-control" id="input_ingredients">{{ $recipe->ingredients }}</textarea>
</div>

<div class="form-group">
    <label for="input_steps">Steps:</label>
    <textarea name="steps" class="form-control" id="input_steps">{{ $recipe->steps }}</textarea>
</div>

<div class="form-group">
	<label for="input_image">Image:</label>
	<input type="file" name="image" class="form-control" id="input_image">
</div>

<div class="form-group">
	<input type="checkbox" name="is_public" id="input_featured" {{ $recipe->is_public ? 'checked' : '' }}>
	<label for="input_public">Is public</label>
</div>

<button type="submit" class="btn btn-primary">
	<i class="fa fa-check"></i> Save
</button>

<a href="{{ route('recipes.index') }}" class="btn btn-outline-primary">
	<i class="fa fa-chevron-left"></i> Back
</a>
