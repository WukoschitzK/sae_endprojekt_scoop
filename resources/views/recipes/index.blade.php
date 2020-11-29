@extends('layouts.master')

@section('title', trans('recipes.title'))

@section('container')

	<h1>Recipes</h1>

	<ul>
		@foreach($recipes as $recipe)
			<li>
				<a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
				@if($recipe->is_featured)
					<span>{{ trans('recipes.featured') }}</span>
				@endif
				{{--@if($recipe->user)
					<br><small>{{ $recipe->user->name }}</small>
				@endif--}}
			</li>
		@endforeach
	</ul>

	<a href="{{ route('recipes.create') }}" class="btn btn-primary">
		<i class="fa fa-plus"></i> Create new recipe
	</a>

@endsection
