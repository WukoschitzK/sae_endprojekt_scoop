<header>
    <nav>
        <div class="navigation-desktop">
            <div class='navigation-desktop-flex'>
                <div class="navigation-desktop-flex-left">
                    <div>
                        <a href="/"><img src="/images/svg/logo_scoop.svg" alt="Logo" class="logo"/></a>
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
                                        <a href="{{ url('/recipes/' . auth()->user()->id) . '/showMyRecipes'}}">My Recipes</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/recipes/' . auth()->user()->id) . '/showMyFavorites'}}">Favorites</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/profile/' . auth()->user()->id) . '/showMyFollowing'}}">Following</a>
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
                            <a href="/search"><img src="/images/svg/searchIcon.svg" alt="Search Icon" class="icon search-icon" /></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="navigation-mobile">
            <div class="navigation-mobile-flex">

                <div class="menu-btn">
                    <div class="menu-btn__burger js-menu-btn"></div>
                </div>

                <div>
                    <a href="/"><img src="/images/svg/logo_scoop.svg" alt="Logo" class="logo"/></a>
                </div>

                <div>

                    <a href="/search"><img src="/images/svg/searchIcon.svg" alt="Search Icon" class="icon" /></a>

                </div>
            </div>

            <div class="navigation-mobile-open-navpoints ">
                <ul>
                    <li>
                        <a href="{{ route('recipes.index') }}">All Recipes</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.getRegistration') }}">Sign Up</a>
                    </li>
                    @if(!auth()->check())
                    <li>
                        <a href="/login">Login</a>
                    </li>
                    @else()
                    <li>
                        <a href="{{ url('/profile/' . auth()->user()->id) }}"
                        class="navigation-desktop-profile-navigation-points">{{auth()->user()->name}}</a><i class="fas fa-caret-down js-toggle-icon"></i>

                        <ul class="open-user-navigation-points">
                            <li>
                                <a href="{{ url('/recipes/' . auth()->user()->id) . '/showMyRecipes'}}">My Recipes</a>
                            </li>
                            <li>
                                <a href="{{ url('/recipes/' . auth()->user()->id) . '/showMyFavorites'}}">Favorites</a>
                            </li>
                            <li>
                                <a href="{{ url('/profile/' . auth()->user()->id) . '/showMyFollowing'}}">Following</a>
                            </li>
                            <li>
                                <a href="{{ route('auth.logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                    @endif()
                </ul>
            </div>

        </div>
    </nav>
</header>
