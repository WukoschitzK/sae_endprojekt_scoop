@extends('layouts.master')

@section('title', 'Login')

@section('container')

	<div class="card mt-4">
		<div class="card-body">

			<form method="post" action="{{ route('auth.postLogin') }}" autocomplete="off">

				@csrf

				<div class="form-group">
					<label for="input_email">Email:</label>
					<input type="email" name="email" value="" class="form-control" id="input_email">
				</div>

				<div class="form-group">
					<label for="input_password">Password:</label>
					<input type="password" name="password" value="" class="form-control" id="input_password">
				</div>

				<div class="form-group">
					<input type="checkbox" name="remember_me" id="input_remember">
					<label for="input_remember">Remember me</label>
				</div>

				<button type="submit" class="btn btn-primary">
					<i class="fa fa-check"></i> Login
				</button>

			</form>

		</div>
	</div>

@endsection
