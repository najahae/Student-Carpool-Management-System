@extends('driver.layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])

@section('content')
@include('driver.carpool.table', ['carpool' => $carpool])
@endsection