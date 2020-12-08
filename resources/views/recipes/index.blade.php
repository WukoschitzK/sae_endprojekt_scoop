@extends('layouts.master')

{{--@section('title', trans('recipes.title'))--}}

@section('container')

{{--	<h1>Recipes</h1>--}}

{{--	<ul>--}}
{{--		@foreach($recipes as $recipe)--}}
{{--			<li>--}}
{{--				<a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>--}}
{{--				@if($recipe->is_featured)--}}
{{--					<span>{{ trans('recipes.featured') }}</span>--}}
{{--				@endif--}}
{{--				@if($recipe->user)--}}
{{--					<br><small>{{ $recipe->user->name }}</small>--}}
{{--				@endif--}}
{{--			</li>--}}
{{--		@endforeach--}}
{{--	</ul>--}}

{{--	<a href="{{ route('recipes.create') }}" class="btn btn-primary">--}}
{{--		<i class="fa fa-plus"></i> Create new recipe--}}
{{--	</a>--}}



{{--All Recipes--}}

    <div class="wrapper">
        <div class="h1 heading-line d-inline-block">All Recipes</div>

        <a href="{{route('recipes.create')}}">New Recipe!</a>


        <div class="filter-desktop margin-bottom-30">
            <div>
                <div class="wrapper-filter">
                    <h3>Filter<span class="filter-counter">(3)</span><i class="fas fa-caret-down"></i></h3>
                </div>
            </div>


            <div class="form-recipe-wrapper-input">
                <div class="text-bold margin-bottom-10">Allergens</div>
                <ul class="allergen-tiles-wrapper">
                    @foreach($allergens as $allergen)
                        <li class="js-allergen-tile">
                            <label for="input_allergen">{{$allergen->name}}</label>
                            <input type="checkbox" name="allergens[]" value="{{$allergen->id}}" id="input_allergen" class="tryAllergen">
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>




{{--test--}}
        @foreach($categories as $category)
            <li class="brandLi">
                <input type="checkbox" id="brandId" value="{{$category->id}}" class="try"/>
                <div>  {{$category->name}}</div>
            </li>
        @endforeach
{{--endtest--}}




{{--        if desktop:--}}

{{--        <div class="categories-desktop margin-bottom-30">--}}
{{--            <ul class="categories-wrapper">--}}
{{--                @foreach($categories as $category)--}}
{{--                    <li class="category-item">--}}
{{--                        {{$category->name}}--}}
{{--                        <a href="{{ url('/recipes/?category=' . $category->id)}}">{{$category->name}}</a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        else:--}}
{{--        <div class="margin-bottom-30">--}}
{{--            <div class="wrapper-categories">--}}
{{--                <div class="wrapper-categories-dropdown">--}}
{{--                    <h3>Category <i class="fas fa-caret-down"></i></h3>--}}
{{--                    <div>--}}
{{--                        <ul class="categories-wrapper">--}}
{{--                            @foreach($categories as $category)--}}
{{--                            <li class="category-item">--}}
{{--                                <a href="{{ url('/recipes/?category=' . $category->name)}}">{{$category->name}}</a>--}}

{{--                            </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        {{--        Recipe cards--}}
        <div class="recipe-cards-wrapper-flex">
                @foreach($recipes as $recipe)
                    <div class="margin-bottom-50 recipe-element">
                        <div class="recipe-card-wrapper">
                            @if($recipe->user)
                                <div>
                                {{ $recipe->user->name }}
                                </div>
                            @endif

                                <a href="{{ route('recipes.show', $recipe->id) }}">
                                    <div class="recipe-card">
                                        <div>{{--                image--}}</div>
                                        <div class="recipe-card-text">
                                            <h2>{{ $recipe->title }}</h2>
                                            <p>{{ $recipe->description }}</p>
                                        </div>

                                    </div>
                                </a>
                        </div>
                    </div>
                @endforeach
        </div>


{{--        {{ $recipes->links() }}--}}
    </div>

@endsection
