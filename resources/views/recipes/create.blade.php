@extends('layouts.master')

@section('title', 'Create')

@section('container')

	<div class="card mt-4">
		<div class="card-body">

			<form method="post" action="{{ route('recipes.store') }}" enctype="multipart/form-data" autocomplete="off">

				@csrf

				@include('recipes._form')

			</form>

		</div>
	</div>

@endsection
