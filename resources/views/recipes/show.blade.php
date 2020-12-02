@extends('layouts.master')

{{--@section('title', $recipe->title)--}}

@section('container')

	<div class="card mt-4">
		<div class="card-body">



			<h2>{{ $recipe->title }}</h2>

			@if($recipe->is_public)
				<div class="alert alert-info">public!</div>
			@endif

			@if($recipe->ingredients)
				<p>{{ $recipe->ingredients }}</p>
			@endif

            @if($recipe->steps)
                <p>{{ $recipe->steps }}</p>
            @endif

			@if($recipe->image_path)
				<img class="w-50" src="{{ $recipe->image_url }}">
			@endif


            <a href="{{ url('/user-profile/' . $user->id)}}"><p>User: {{ $user->name }}</p></a>

{{--			<p>{{ nice_date($recipe->created_at) }}</p>--}}

			<a href="{{ route('recipes.index') }}" class="btn btn-outline-primary">
				<i class="fa fa-chevron-left"></i> Back
			</a>

			<a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary">
				<i class="fa fa-pencil"></i> Edit
			</a>

			<form method="post" action="{{ route('recipes.destroy', $recipe->id) }}" autocomplete="off" onsubmit="return confirm('Are you sure?')">

				@method('delete')
				@csrf

				<button type="submit" class="btn btn-outline-danger mt-2">
					<i class="fa fa-trash"></i> Delete
				</button>

			</form>

		</div>
	</div>

@endsection
