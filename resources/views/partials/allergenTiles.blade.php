<div>
    <div>
        <ul class="allergen-tiles-wrapper">
            @foreach($allergens as $allergen)
            <li class="js-allergen-tile">
                {{$allergen->name}}
            </li>
            @endforeach
        </ul>
    </div>
</div>
