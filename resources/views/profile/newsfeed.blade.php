@extends('layouts.master')

@section('title', $user->name)

@section('container')

	<div class="card mt-4">
		<div class="card-body">

			<h2>{{ $user->name }}</h2>

			@if($user->description)
				<p>{{ $user->description }}</p>
			@endif

			@if($user->image_url)
				<img class="w-50" src="{{ $user->image_url }}">
			@endif

            <h3>Recipes: {{$recipes->count()}}</h3>
            <h3>Followers: {{$followers->count()}}</h3>






			<form method="post" action="{{ route('profile.follow', $user->id) }}" autocomplete="off")">
				@csrf

				<button type="follow" class="btn btn-info mt-2">
					Follow
				</button>

			</form>

            <form method="post" action="{{ route('profile.unfollow', $user->id) }}" autocomplete="off")">


                @csrf

                <button type="unfollow" class="btn btn-warning mt-2">
                    Unfollow
                </button>

            </form>

		</div>
	</div>

@endsection
