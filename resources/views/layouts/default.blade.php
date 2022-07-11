<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::currentLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (App::currentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('boot/css/bootstrap.rtl.min.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('boot/css/bootstrap.min.css') }}" />
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        < link rel = "stylesheet"
        href = "{{ asset('headers.css') }}" / >
    </script>
    <title>{{ config('app.name') }}</title>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <a href="{{ route('questions.index') }}">
                        <h4 class="text-successfully btn btn-danger">{{ __('Questions And Answers') }}</h4>
                    </a>
                </ul>

                <form action="{{ route('questions.index') }}" method="GET"
                    class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="{{ __('Search...') }}"
                        aria-label="Search">
                </form>

                <div class="dropdown text-end p-3">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="locale"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        {{ __('Language') }}
                    </a>
                    <ul class="me-1 dropdown-menu text-small" aria-labelledby="locale">
                        <li><a class="dropdown-item" href="{{ URL::current() }}?lang=en">English</a></li>
                        <li><a class="dropdown-item" href="{{ URL::current() }}?lang=ar">العربية</a></li>
                    </ul>
                </div>
                @auth


                    <x-notifications-menu />
                    @if (Auth::user()->type == 'super-admin')
                        <div class="ms-2 dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="mdo"
                                        width="32" height="32" class="rounded-circle">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="mdo"
                                        width="32" height="32" class="rounded-circle">
                                @endif

                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('questions.index') }}">{{ __('Questions') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('tags.index') }}">{{ __('Tags') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('password.change') }}">{{ __('Chnage Password') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" onclick="document.getElementById('logout').submit()"
                                        href="javascript:;">{{ __('Sign out') }}</a></li>
                                <form action="{{ route('logout') }}" method="post" id="logout"
                                    style="display: none;">
                                    @csrf</form>


                            </ul>
                        </div>
                    @else
                        <div class="ms-2 dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="mdo"
                                        width="32" height="32" class="rounded-circle">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="mdo"
                                        width="32" height="32" class="rounded-circle">
                                @endif

                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('dashboard-user') }}">{{ __('Dashboard') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('password.change') }}">{{ __('Chnage Password') }}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('questions.index') }}">{{ __('Questions') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" onclick="document.getElementById('logout').submit()"
                                        href="javascript:;">{{ __('Sign out') }}</a></li>
                                <form action="{{ route('logout') }}" method="post" id="logout"
                                    style="display: none;">
                                    @csrf</form>


                            </ul>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary ">{{ __('login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-success px-2">{{ __('register') }}</a>

                @endauth
            </div>
        </div>
    </header>
    <div class="container py-5">

        <h2>@yield('title')</h2>

        @yield('content')

    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const userId = "{{ Auth::id() }}";
    </script>
    <script src="{{ asset('boot/js/app.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    </body>

</html>
