@extends('layouts.master')

@section('title', 'Edit')

@section('container')

	<div class="card mt-4">
		<div class="card-body">

			<form method="post" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data" autocomplete="off">

				@method('put')
				@csrf

				@include('recipes._form')

			</form>

		</div>
	</div>

@endsection
