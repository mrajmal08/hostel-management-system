<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <div class="hamburger sidebar-toggle">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>
            <div class="float-right">
                @guest
                    @if (Route::has('login'))
                        <span class="user-avatar">
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </span>
                    @endif

                    @if (Route::has('register'))
                        <span class="user-avatar">
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </span>
                    @endif

                    <div class="dropdown dib">
                        @else
                            <div class="header-icon">
                                <span class="user-avatar">
                                     <a href="{{ route('logout') }}"><i class="ti-power-off"></i> Logout</a>
                                </span>
                            </div>
                        @endguest
                    </div>
            </div>
        </div>
    </div>
</div>
