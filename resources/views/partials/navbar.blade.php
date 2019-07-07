<nav class="bg-white shadow">
    <div class="container mx-auto">

        <div class="flex justify-between items-center py-2">

            <h1>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/img/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}"/>
                    <span class="text-xl font-bold text-blue-500">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </h1>

            <div>
                <!-- Right Side Of Navbar -->
                <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="">
                            <a class="inline-block py-2 px-4 no-underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="">
                                <a class="inline-block py-2 px-4 no-underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class=" relative">
                            <a id="navbarDropdown" class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" role="button" data-toggle="relative" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </div>
</nav>
