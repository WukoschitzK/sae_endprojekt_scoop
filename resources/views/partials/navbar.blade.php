<header>
    <nav>
{{--        desktop:--}}

        <div class="navigation-desktop">
            <div class='navigation-desktop-flex'>
                <div class="navigation-desktop-flex-left">
                    <div>
                        <a href="/"><img src="images/svg/logo_scoop.svg" alt="Logo" class="logo"/></a>
                    </div>
                    <div>
                        <ul class="navigation-desktop-flex-left-links">

                            <li>
                                <a href="{{ route('recipes.index') }}">All Recipes</a>
                            </li>
                            @if(!auth()->check())
                            <li>
                                <a href="{{ route('auth.getRegistration') }}">Sign Up</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="navigation-desktop-flex-right">
                    <ul class='navigation-desktop-profile-navigation-points-container'>
                        <li>
                            @if(auth()->check())
                                <a class="navigation-desktop-profile-navigation-points" href="{{ url('/profile/' . auth()->user()->id) }}">
                                    {{auth()->user()->name}}
                                </a><i class="fas fa-caret-down js-toggle-icon"></i>

                                <ul class="open-user-navigation-points js-open-navigation-points">
                                    <li>
                                        <a href="{{ route('recipes.index') }}">Newsfeed</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('recipes.index') }}">My Recipes</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('recipes.index') }}">Favorites</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('recipes.index') }}">Following</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('auth.logout') }}">Logout</a>
                                    </li>
                                </ul>
                            @else
                                <a href="{{ route('auth.getLogin') }}" class="nav-link">Login</a>
                            @endif
                        </li>
                        <li>
                            <a href="/search"><img src="images/svg/searchIcon.svg" alt="Search Icon" class="icon search-icon" /></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


{{--        mobile:--}}

{{--        <div class="">--}}
{{--            <div class="navigation-mobile-flex">--}}

{{--                <div class="">--}}
{{--                    <div class="menu-btn__burger"></div>--}}
{{--                </div>--}}

{{--            <div>--}}
{{--                <a href="/"><img src="" alt="Logo" class="logo"/></a>--}}
{{--            </div>--}}

{{--            <div>--}}

{{--                <a href="/search"><img src="" alt="Search Icon" class="icon" /></a>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="navigation-mobile-open-navpoints">--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="/all-recipes">All Recipes</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="/sign-up">Sign Up</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="/login">Login</a>--}}
{{--                </li>--}}

{{--                <li>--}}

{{--                    <a href="/newsfeed"--}}
{{--                    class="navigation-desktop-profile-navigation-points">Jody Johnson</a>--}}

{{--                    <ul class="open-user-navigation-points">--}}
{{--                        <li>--}}
{{--                            <a href="/newsfeed">Newsfeed</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="/my-recipes">My Recipes</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="/favorites">Favorites</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="/following">Following</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="/logout">Logout</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}


{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        </div>--}}

    </nav>
</header>
