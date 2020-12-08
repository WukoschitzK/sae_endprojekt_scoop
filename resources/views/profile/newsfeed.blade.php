@extends('layouts.master')

{{--@section('title', $user->name)--}}

@section('container')

	<div class="card mt-4">
		<div class="card-body">

            @foreach($recipes as $recipe)
                <div>{{$recipe->user_id}}</div>
                <div>{{$recipe->title}}</div>
                <div>{{$recipe->description}}</div>
            @endforeach()

		</div>
	</div>

@endsection
