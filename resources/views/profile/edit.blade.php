@extends('layouts.master')

@section('title', 'Edit')

@section('container')

	<div class="card mt-4">
		<div class="card-body">

{{--			<form method="post" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data" autocomplete="off">--}}

{{--				@method('put')--}}
{{--				@csrf--}}

{{--				--}}

{{--			</form>--}}

            <form method="post" action="{{ route('profile.update', $user->id) }}" autocomplete="off">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="input_name">Name:</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="input_name">
                </div>

                <div class="form-group">
                    <label for="input_email">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="input_email">
                </div>

                <div class="form-group">
                    <label for="input_password">Password:</label>
                    <input type="password" name="password" value="{{ $user->password }}" class="form-control" id="input_password">
                </div>



                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Save
                </button>

            </form>

		</div>
	</div>

@endsection
