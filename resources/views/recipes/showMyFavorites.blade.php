@extends('layouts.master')

{{--@section('title', trans('recipes.title'))--}}

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">My Favorites</div>

        <div class="recipe-cards-wrapper-flex">
            @foreach($recipes as $recipe)
                <div class="margin-bottom-50 recipe-element">
                    <div class="recipe-card-wrapper">
                        <a href="{{ route('recipes.show', $recipe->id) }}">
                            <div class="recipe-card">
                                <div>

                                    @if($recipe->image_path)
                                        <img class="recipe-detail-img" src="/storage/images/recipe_images/{{ $recipe->image_path }}" alt="Picture of Recipe" />
                                    @else
                                        <img class="recipe-detail-img" src="/images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                                    @endif
                                </div>
                                <div class="recipe-card-text">
                                    <h2>{{ $recipe->title }}</h2>
                                    <p>{{ $recipe->description }}</p>
                                </div>
                                @if($recipe->user)
                                    <div>
                                        {{ $recipe->user->name }}
                                    </div>
                                @endif

                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
