@extends('driver.layouts.app', ['page' => __('Maps'), 'pageSlug' => 'maps'])

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Route and Fare Calculation</h4>
                </div>
                <div class="card-body">
                    <form id="routeForm">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="pickup" class="form-label">Pick-Up Location</label>
                                <input type="text" id="pickup" class="form-control" placeholder="Enter pick-up location">
                            </div>
                            <div class="col-md-6">
                                <label for="dropoff" class="form-label">Drop-Off Location</label>
                                <input type="text" id="dropoff" class="form-control" placeholder="Enter drop-off location">
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" id="calculate" class="btn btn-primary w-100">Calculate Route</button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <p><strong>Distance:</strong> <span id="distance"></span></p>
                        <p><strong>Duration:</strong> <span id="duration"></span></p>
                        <p><strong>Estimated Fare (RM):</strong> <span id="fare"></span></p>
                    </div>

                    <div id="map" class="mt-3" style="height: 400px; border-radius: 8px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places"></script>
<script>
    function initAutocomplete() {
        new google.maps.places.Autocomplete(document.getElementById("pickup"));
        new google.maps.places.Autocomplete(document.getElementById("dropoff"));
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 2.3148, lng: 102.3188 }, // Default UiTM Jasin location
            zoom: 13
        });

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        document.getElementById('calculate').addEventListener('click', function() {
            var pickup = document.getElementById('pickup').value;
            var dropoff = document.getElementById('dropoff').value;

            if (!pickup || !dropoff) {
                alert('Please enter both pickup and drop-off locations.');
                return;
            }

            var request = {
                origin: pickup,
                destination: dropoff,
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);

                    var distanceText = result.routes[0].legs[0].distance.text;
                    var durationText = result.routes[0].legs[0].duration.text;
                    var distanceValue = result.routes[0].legs[0].distance.value / 1000;

                    var fareRate = 1.00; // Set fare per km (adjust if needed)
                    var estimatedFare = (distanceValue * fareRate).toFixed(2);

                    document.getElementById('distance').innerText = distanceText;
                    document.getElementById('duration').innerText = durationText;
                    document.getElementById('fare').innerText = `RM ${estimatedFare}`;
                } else {
                    alert('Could not retrieve directions. Please try again.');
                }
            });
        });
    }

    window.onload = function() {
        initAutocomplete();
        initMap();
    };
</script>
@endpush
