<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (LaravelLocalization::getCurrentLocaleName() == 'Armenian')
        <link rel="stylesheet" href="{{ asset('css/arm.css?version=4') }}" />
    @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
        <link rel="stylesheet" href="{{ asset('css/newest-index.css?version=62') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('css/russ.css?version=4') }}" />
    @endif

    @yield('styles')
    <script src="{{ asset('js/newest-index.js?version=4') }}" defer></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        window.uuxyz = <?php echo json_encode([
    'uuxyzd' => Auth::check() ? base64_encode(auth()->user()->id) : null,
    'uuxyzt' => Auth::check() ? base64_encode(auth()->user()->api_token) : null,
    'uuxyzq' => Auth::check() ? base64_encode(auth()->user()->unique_id) : null,
]);
?>
    </script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>

    <title>Magaxat | Home</title>
</head>

<body>
    <div class="navbar-wrapper">
        <div class="navbar">
            <div class="menu-bars" id="menu-bars">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div class="navbar-logo-wrapper">
                <div class="navbar-logo-container">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('images/img/navbar-logo.png') }}" alt="Magaghat" class="navbar-logo" />
                    </a>
                </div>

                <div class="navbar-links-wrapper">
                    <ul class="navbar-links-list">
                        <li class="navbar-link"><a
                                class="{{ Route::currentRouteName() == 'all-videos' ? 'navbar-active-item' : '' }}"
                                href="{{ route('all-videos') }}">{{ __('translations.users_video') }}</a></li>
                        <li class="navbar-link"><a
                                class="{{ Route::currentRouteName() == 'all-users' ? 'navbar-active-item' : '' }}"
                                href="{{ route('all-users') }}">{{ __('translations.users') }}</a></li>
                        <li class="navbar-link"><a
                                class="{{ Route::currentRouteName() == 'all-appeals' ? 'navbar-active-item' : '' }}"
                                href="{{ route('all-appeals') }}">{{ __('translations.benefac_fond') }}</a></li>
                        <li class="navbar-link"><a
                                class="{{ Route::currentRouteName() == 'all-benefactors' ? 'navbar-active-item' : '' }}"
                                href="{{ route('all-benefactors') }}">{{ __('translations.benefac') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="navbar-user-section-wrapper">
                @if (Auth::check())
                    <div class="navbar-chat-icon">
                        <a href="{{ route('user.chat') }}"><i class="fa-regular fa-comment"></i></a><span><a
                                href="{{ route('user.chat') }}">{{ __('translations.chat') }}</a></span>
                    </div>
                    <div class="navbar-user-list">
                        <div class="navbar-user-image-wrapper">
                            <a href="{{ route('user.profile') }}">
                                <img src="{{ asset(auth()->user()->image ?? 'images/avatar.png') }}"
                                    alt="user-image" />
                            </a>
                        </div>
                        <a href="{{ route('user.profile') }}">
                            <span class="navbar-user-name">{{ auth()->user()->name }}</span>
                        </a>
                        <i class="fa-solid fa-angle-down user-navbar-arrow"></i>
                    </div>
                    <div class="user-adds-list">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">{{ __('translations.log_out') }}</button>
                        </form>
                    </div>
                @else
                    <div class="login-navbar-user">
                        <a href="{{ route('login') }}">
                            <button class="login-navbar-user-btn">{{ __('translations.log_in') }}</button>
                        </a>
                    </div>
                @endif
                <div class="navbar-languages-list">
                    @if (LaravelLocalization::getCurrentLocaleName() == 'Armenian')
                        <span>ARM</span>
                        <i class="fa-solid fa-angle-down languages-icon"></i>
                    @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
                        <span>ENG</span>
                        <i class="fa-solid fa-angle-down languages-icon"></i>
                    @else
                        <span>RUS</span>
                        <i class="fa-solid fa-angle-down languages-icon"></i>
                    @endif
                </div>
                <div class="languages-list" id="languages-list">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode == 'en')
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ENG</a>
                            </div>
                        @elseif($localeCode == 'ru')
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">RUS</a>
                            </div>
                        @else
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ARM</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="overlay" id="overlay">
            <ul class="overlay-list">
                <li class="overlay-list-item">
                    <img src="{{ asset('images/img/video-clips.png') }}" alt="" />
                    <a rel="preconnect" href="{{ route('all-videos') }}">{{ __('translations.users_video') }}</a>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li class="overlay-list-item">
                    <img src="{{ asset('images/img/users.png') }}" alt="" />
                    <a rel="preconnect" href="{{ route('all-users') }}">{{ __('translations.users') }}</a>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li class="overlay-list-item">
                    <img src="{{ asset('images/img/benefactor-fonds.png') }}" alt="" />
                    <a rel="preconnect"
                        href="{{ route('all-appeals') }}">{{ __('translations.benefac_fond') }}</a>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li class="overlay-list-item">
                    <img src="{{ asset('images/img/benefactor.png') }}" alt="" />
                    <a rel="preconnect" href="{{ route('all-benefactors') }}">{{ __('translations.benefac') }}</a>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li class="overlay-list-item">
                    @if (LaravelLocalization::getCurrentLocaleName() == 'Armenian')
                        <span>ARM</span>
                    @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
                        <span>ENG</span>
                    @else
                        <span>RUS</span>
                    @endif
                    <span rel="preconnect" class="mobile-language-title"
                        href="">{{ __('translations.language') }}</span>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <div class="mobile-languages-list">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode == 'en')
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ENG</a>
                            </div>
                        @elseif($localeCode == 'ru')
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">RUS</a>
                            </div>
                        @else
                            <div class="language-item-wrapper">
                                <a
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ARM</a>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if (Auth::check())
                    <li class="overlay-list-item">
                        <a href="{{ route('user.chat') }}"><i class="fa-regular fa-comment"></i></a><span><a
                                href="{{ route('user.chat') }}">{{ __('translations.chat') }}</a></span>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="overlay-list-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="mobile-logut-button">{{ __('translations.log_out') }}</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <div class="img-container" data-slideshow>
            <div>
                <img src="{{ asset('images/img/slider-1.png') }}" />
                <p class="slider-text">
                    As well as diluted with a fair amount of empathy, rational thinking
                    largely determines the importance of the positions taken by the
                    participants in relation to the tasks assigned. As is commonly
                    believed, interactive prototypes are only a method of political
                    participation and are associatively distributed across industries.
                </p>
            </div>
            <div>
                <img src="{{ asset('images/img/slider-2.png') }}" />
            </div>
            <div>
                <img src="{{ asset('images/img/slider-3.png') }}" />
            </div>
        </div>

    </div>

    @yield('content')

    @stack('js')
    <script>
        var swiper = new Swiper(".myMainSwiper", {
            spaceBetween: 30,
            autoplay: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
        var swiper2 = new Swiper(".appealsSwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            // loop:true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1100: {
                    slidesPerView: 3,
                },

                768: {
                    slidesPerView: 2,
                },

                500: {
                    slidesPerView: 1,
                },

                300: {
                    slidesPerView: 1,
                },
            },
        });
    </script>
</body>

</html>
