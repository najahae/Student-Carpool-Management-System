@extends('layouts.app', ['page' => __('Vehicle Information'), 'pageSlug' => 'vehicles'])

@section('content')
@include('driver.vehicle.table', ['car' => $car])
@endsection