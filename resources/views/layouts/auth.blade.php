<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
      <link rel="stylesheet" href="{{asset('css/arm.css?version=4')}}" />
    @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
      <link rel="stylesheet" href="{{asset('css/newest-index.css?version=61')}}" />
    @else
      <link rel="stylesheet" href="{{asset('css/russ.css?version=4')}}" />
    @endif
    
    <script src="{{asset('js/newest-index.js?version=2')}}" defer></script>
    <title>@yield('title')</title>
  </head>
  <body>
    <div class="auth-navbar-background-wrapper">
      <div class="navbar">
        <div class="menu-bars" id="menu-bars">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <div class="navbar-logo-wrapper">
          <div class="navbar-logo-container">
            <a href="{{ route('welcome') }}">
              <img src="{{asset('images/img/navbar-logo.png')}}" alt="" class="navbar-logo" />
            </a>
          </div>
          
          <div class="navbar-links-wrapper">
          <ul class="navbar-links-list">
            <li class="navbar-link"><a class="{{ Route::currentRouteName() == 'all-videos' ? 'navbar-active-item' : '' }}" href="{{ route('all-videos') }}">User Videos</a></li>
            <li class="navbar-link"><a class="{{ Route::currentRouteName() == 'all-users' ? 'navbar-active-item' : '' }}" href="{{ route('all-users') }}">Users</a></li>
            <li class="navbar-link"><a class="{{ Route::currentRouteName() == 'all-appeals' ? 'navbar-active-item' : '' }}" href="{{ route('all-appeals') }}">Benefactor Fonds</a></li>
            <li class="navbar-link"><a class="{{ Route::currentRouteName() == 'all-benefactors' ? 'navbar-active-item' : '' }}" href="{{ route('all-benefactors') }}">Benefactors</a></li>
          </ul>
        </div>
        </div>
        
        <div class="navbar-user-section-wrapper">
          
          <div class="navbar-languages-list">
            
            @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
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
          <div class="languages-list">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              @if($localeCode == 'en')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ENG</a>
              </div>
              @elseif($localeCode == 'ru')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">RUS</a>
              </div>
              @else
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ARM</a>
              </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="overlay" id="overlay">
        <ul class="overlay-list">
          <li class="overlay-list-item">
            <img src="{{asset('images/img/video-clips.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-videos') }}">User Videos</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/users.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-users') }}">Users</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/benefactor-fonds.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-appeals') }}">Benefactor Fonds</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/benefactor.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-benefactors') }}">Benefactors</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
              <span>ARM</span>
            @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
              <span>ENG</span>
            @else
              <span>RUS</span>
            @endif
            <span rel="preconnect" class="mobile-language-title" href="">Language</span>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <div class="mobile-languages-list">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              @if($localeCode == 'en')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ENG</a>
              </div>
              @elseif($localeCode == 'ru')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">RUS</a>
              </div>
              @else
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ARM</a>
              </div>
              @endif
            @endforeach
          </div>
          <li class="overlay-list-item">
            <i class="fa-regular fa-comment"></i><span>Chat</span>
          </li>
        </ul>
      </div>
    </div>
   
      
     
    @yield('content')

    @stack('js')
  </body>
</html>
