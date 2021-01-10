@extends('layouts.master')

{{--@section('search')--}}

@section('container')

    <div class="wrapper">
        <h1>Search</h1>

        <div class="searchform">
            {!! Form::open(['url' => 'search', 'method' => 'get']) !!}
            {!! Form::text('search', null, ['class' => 'search-input', 'placeholder' => 'Suche...']) !!}
            {!! Form::button('<i class="fa fa-search fa-2x"></i>', ['type' => 'submit', 'class' => 'search-button']) !!}
            {!! Form::close() !!}
        </div>








            @if($recipes->count() < 1)
                <p>kein ergebnis</p>

            @else()
                    @foreach ($recipes as $recipe)
                        <div>
                            <h2>{{ $recipe->title }}</h2>
                        </div>
                    @endforeach
            @endif

    </div>

@endsection
