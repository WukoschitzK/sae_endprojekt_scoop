@extends('layouts.master')

{{--@section('search')--}}

@section('container')

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">Search</div>

        <div class="search-form-relative margin-bottom-30">
            <div class="search-form">
            {!! Form::open(['url' => 'search', 'method' => 'get']) !!}
            {!! Form::text('search', null, ['class' => 'search-input', 'placeholder' => 'e.g. Apple']) !!}
            {!! Form::button('Go', ['type' => 'submit', 'class' => 'search-button']) !!}
            {!! Form::close() !!}
            </div>
        </div>



        @if($recipes->count() < 1)

            <p>Sorry, we can't find the recipe you're searching for!</p>

        @else()

            <h2 class="margin-bottom-20">Results</h2>

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
                                            <img class="recipe-detail-img" src="../images/recipe-image-placeholder.jpg" alt="Placeholderimage of Recipe" />
                                        @endif
                                    </div>
                                    <div class="recipe-card-text">
                                        <h2>{{ $recipe->title }}</h2>
                                        <p>{{ $recipe->description }}</p>

                                        {{--                                            todo: cannot show user?--}}
                                        <div class="recipe-card-profile-info">
                                            @if($recipe->user->image_path)
                                                <img class="profile-image" src="/storage/images/profile_images/{{ $recipe->user->image_path }}">
                                            @else
                                                <img class="profile-image" src="/images/avatar.png" alt="Profile Image" />
                                            @endif
                                            <div>
                                                {{ $recipe->user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>






{{--                    @foreach ($recipes as $recipe)--}}
{{--                        <div>--}}
{{--                            <h2>{{ $recipe->title }}</h2>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
            @endif

    </div>

@endsection
