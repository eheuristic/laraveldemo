<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel 4</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="/">Home</a></li>
                 @if (Sentry::check())
                 <li {{ (Request::is('/history') ? ' class="active"' : '') }}><a href="/history">Mail History</a></li>
                 @endif
            </ul>
            <ul class="nav navbar-nav nav pull-right">
            @if (Sentry::check())
                   <li><a href="javascript:void(0);">Welcome, {{ Sentry::getUser()->email }}</a></li>
                   <li><a href="{{ URL::to('user/logout') }}">Logout</a></li>
            @else
                <li {{ (Request::is("user/register") ? ' class="active"' : '') }}><a href="{{{ URL::to('user/register')}}}">Register</a></li>
                <li {{ (Request::is("user/login") ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login')}}}">Login</a></li>
            @endif
                
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
