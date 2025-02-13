@extends('passenger.layouts.app', ['page' => __('List of Carpools'), 'pageSlug' => 'carpool'])

@section('content')
@include('passenger.carpool.table')
@endsection
