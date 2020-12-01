@extends('layouts.master')

@section('title', 'Create')

@section('container')

    <div class="wrapper">

        <div class="h1 heading-line d-inline-block">New Recipe</div>


        <form method="post" action="{{ route('recipes.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf

            @include('recipes._form')

        </form>



    </div>

@endsection
