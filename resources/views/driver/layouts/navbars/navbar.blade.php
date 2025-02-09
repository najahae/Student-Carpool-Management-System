@auth()
    @include('driver.layouts.navbars.navs.auth')
@endauth

@guest()
    @include('driver.layouts.navbars.navs.guest')
@endguest
