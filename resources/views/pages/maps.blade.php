@extends('layouts.app', ['page' => __('Maps'), 'pageSlug' => 'maps'])

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Google Map - Route and Fare Calculation</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="pickup">Pick-Up Location</label>
                <input type="text" id="pickup" class="form-control" placeholder="Enter pick-up location">
            </div>
            <div class="form-group">
                <label for="dropoff">Drop-Off Location</label>
                <input type="text" id="dropoff" class="form-control" placeholder="Enter drop-off location">
            </div>
            <button id="calculate" class="btn btn-primary">Calculate Route</button>
            <div class="mt-3">
                <p id="distance"></p>
                <p id="duration"></p>
                <p id="fare"></p>
            </div>
            <div id="map" style="height: 500px;" class="mt-3"></div>
        </div>
    </div>
</div>
@endsection


@push('js')
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwmu2sNtB0IXR-Aw23GJBI0gJjL5itRgk&libraries=places"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initGoogleMaps();
        });
    </script>
@endpush
