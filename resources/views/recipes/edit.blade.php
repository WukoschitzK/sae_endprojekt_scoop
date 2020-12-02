@extends('layouts.master')

@section('title', 'Edit')

@section('container')

    <div class="wrapper">

        <div class="h1 heading-line d-inline-block">Edit Recipe</div>
			<form method="post" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data" autocomplete="off">

				@method('put')
				@csrf

				@include('recipes._form')

			</form>


	</div>

@endsection
