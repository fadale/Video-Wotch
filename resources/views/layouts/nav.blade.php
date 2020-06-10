<nav class="navbar navbar-expand-lg fixed-top bg-danger">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{route('frontend.landing')}}" rel="tooltip" title="Coded by Creative Tim" data-placement="bottom">
                AWSAAL
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Example single danger button -->
                    <div class="dropdown">
                        <a class="nav-link" href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($categories as $category)
                                <a class="dropdown-item" href="{{route('front.category',['id'=>$category->id])}}">{{$category->name}}</a>
                            @endforeach

                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <!-- Example single danger button -->
                    <div class="dropdown">
                        <a class="nav-link" href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Skills
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($skills as $skill)
                                <a class="dropdown-item" href="{{route('front.skill',['id'=>$skill->id])}}">{{$skill->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{route('front.profile',[Auth::user()->id,slug(Auth::user()->name)])}}"class="dropdown-item">Profile</a>
                        </div>
                    </li>
                @endguest

                <li class="nav-item mb-auto mt-auto">
                <form class="form-inline ml-auto mt-auto mb-auto" action="{{route('home')}}">
                    <div class="form-group has-white">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                    </div>
                </form>
                </li>
            </ul>

        </div>
    </div>
</nav>
