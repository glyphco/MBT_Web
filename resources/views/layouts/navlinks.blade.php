    <div class="navbar-header navbar-right pull-right">
      <ul class="nav pull-left">
        <li class="navbar-text pull-left">
@if ($user_data = Request::input('user_data')['name'])
  {{$user_data}}
@else
  User Name
@endif
        </li>
        <li class="dropdown pull-right" >
          <a href="#" data-toggle="dropdown" style="color:#777; margin-top: 0px;" class="dropdown-toggle">
@if ($user_avatar = Request::input('user_data')['avatar'])
            <img class="img-circle img-responsive .img-thumbnail" style="width: 27px;" src='{{$user_avatar}}'>
@else
            <img class="img-circle img-responsive .img-thumbnail" style="width: 27px;" src='@yield('userimage', 'http://lorempixel.com/100/100/people/')'>
@endif
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="/me" title="Profile">Profile</a>
            </li>
            <li>
              <a href="/logout" title="Logout">Logout </a>
            </li>
          </ul>
        </li>
      </ul>
      <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="visible-xs-block clearfix"></div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-left">
        <li class="{{ ((Route::currentRouteName() == 'events') or (Route::currentRouteName() == 'event')) ? 'active' : '' }}"><a href="/events">Events</a></li>
        <li class="{{ ((Route::currentRouteName() == 'venues') or (Route::currentRouteName() == 'venue')) ? 'active' : '' }}"><a href="/venues">Venues</a></li>
        <li class="{{ ((Route::currentRouteName() == 'profiles') or (Route::currentRouteName() == 'profile')) ? 'active' : '' }}"><a href="/profiles">Profiles</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/locator">Chicago</a></li>
      </ul>
    </div>