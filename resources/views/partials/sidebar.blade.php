<div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
        <h1 class="h5">
            @if(Auth::user())
                {{ Auth::user()->name }}
            @endif
        </h1>
        <p>{{ __('roles.name') }}</p>
    </div>
</div>
<!-- Sidebar Navidation Menus--><span class="heading">Main</span>
<ul class="list-unstyled">
    <li><a href="{{ route('home') }}"> <i class="icon-home"></i>Home </a></li>
    <li><a href="{{ route('dashboard.charts') }}"> <i class="icon-grid"></i>{{ __('profile.stats') }} </a></li>
    <li><a href="{{ route('dashboard.clients') }}"> <i class="fa fa-bar-chart"></i>{{ __('profile.clients') }}</a></li>
    <li class="active"><a href="{{ route('dashboard.pastpaid') }}"> <i class="icon-padnote"></i>{{ __('profile.debtors') }}</a></li>
    <li><a href="{{ route('products.index') }}">{{ __('profile.products') }}</a></li>
    <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
</ul><span class="heading">Extras</span>
<ul class="list-unstyled">
    <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
    <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
    <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
</ul>