<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">{{ __('RIDEMATE') }}</a>
        </div>
        <ul class="nav">
            @php
                $pageSlug = $pageSlug ?? ''; // Ensure $pageSlug is always set
            @endphp

            <li class="{{ $pageSlug == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

                    <li class="{{ $pageSlug == 'profile' ? 'active' : '' }}">
                        <a href="{{ route('admin.profile.edit') }}">
                            <i class="tim-icons icon-single-02"></i>
                            <p>{{ __('Admin Profile') }}</p>
                        </a>
                    </li>
        </ul>
    </div>
</div>
