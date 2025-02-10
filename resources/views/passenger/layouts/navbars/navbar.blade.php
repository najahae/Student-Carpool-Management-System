@auth()
    @include('passenger.layouts.navbars.navs.auth')
@endauth

@guest()
    @include('passenger.layouts.navbars.navs.guest')
@endguest
