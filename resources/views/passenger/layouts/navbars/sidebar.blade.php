<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('passenger.home') }}" class="simple-text logo-mini">{{ __('RM') }}</a>
            <a href="{{ route('passenger.home') }}" class="simple-text logo-normal">{{ __('RideMate') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('passenger.home') }}">
                    <i class="tim-icons icon-components"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('passenger.profile.edit') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Profile') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="{{ route('passenger.map.maps') }}">

                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'carpool') class="active " @endif>
                <a href="{{ route('passenger.carpool.index') }}">
                    <i class="tim-icons icon-bus-front-12"></i>
                    <p>{{ __('Join Carpool') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
