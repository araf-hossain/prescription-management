<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/materialize-icon.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/patients.css">
    @yield('csslinks')
  </head>
  <body>
    <header>
      <ul class="sidenav" id="side-menu">
        <li>
          <div class="user-view">
            <a href="#name"><span id="username">Hello, {{Auth::user()->name ?? ''}}</span></a><br>
            <a href="#email"><span id="email">{{Auth::user()->email ?? ''}}</span></a>
          </div>
        </li>
        <li class="divider"></li>
        <li><a href="">Doctor List</a></li>
        <li><a href="">Patient List</a></li>
        <li class="divider"></li>
        <li><a href="{{ route('admin.profile', Auth::user()->id) }}">View Profile</a></li>
        <li><a class="waves-effect modal-trigger" href="#logoutmodal">Logout</a></li>
        <li class="divider"></li>
      </ul>
      <div class="navbar">
        <ul class="dropdown-content" id="userdropdown">
          <li><a href="{{ route('admin.profile', Auth::user()->id) }}">View Profile</a></li>
          <li><a href="#logoutmodal" class="modal-trigger">Logout</a></li>
        </ul>
        <nav class="blue darken-2">
          <div class="container nav-wrapper">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">Online Prescription</a>
            <a href="#!" data-target="side-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              @if(Auth::user())
              <li><a href="{{ route('admin.doctor.list') }}">Doctor List</a></li>
              <li><a href="{{ route('admin.patient.list') }}">Patient List</a></li>
              <li id="user-dropdown">
                <a href="#!" data-target="userdropdown" class="dropdown-trigger">
                  <img src="{{ asset('/images/profile-user-thumb.png') }}" id="thumbnail" alt="My Profile Picture">
                  {{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i>
                </a>
              </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
      <div class="modal" id="logoutmodal">
        <div class="modal-content center">
          <i class="large material-icons white amber-text text-lighten-1 circle">info</i>
          <p class="flow-text">Are you sure you want to logout?</p>
        </div>
        <div class="modal-footer">
          <button class="btn modal-close waves-effect waves-light white teal-text">Cancel</button>
          <a class="btn modal-close waves-effect waves-light" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </div>
    </header>
    <main>
      @yield('content')
    </main>
    <footer></footer>
    <script src="/js/jquery.js" charset="utf-8"></script>
    <script src="/js/materialize.min.js" charset="utf-8"></script>
    <script src="/js/index.js" charset="utf-8"></script>
    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>
    @yield('scripts')
  </body>
</html>
