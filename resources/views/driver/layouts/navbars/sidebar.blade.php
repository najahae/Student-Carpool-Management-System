<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('driver.dashboard') }}" class="simple-text logo-mini">{{ __('RM') }}</a>
            <a href="{{ route('driver.dashboard') }}" class="simple-text logo-normal">{{ __('RideMate') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('driver.dashboard') }}">
                    <i class="tim-icons icon-components"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('driver.profile.edit') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Profile') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="{{ route('driver.map.maps') }}">

                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'vehicles') class="active " @endif>
                <a href="{{ route('driver.vehicle.index') }}">
                    <i class="tim-icons icon-bus-front-12"></i>
                    <p>{{ __('Car Information') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'carpool') class="active " @endif>
                <a href="{{ route('driver.carpool.index') }}">
                    <i class="tim-icons icon-calendar-60"></i>
                    <p>{{ __('Carpool Information') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'booking') class="active " @endif>
                <a href="{{ route('driver.booking.index') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Booking Request') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
