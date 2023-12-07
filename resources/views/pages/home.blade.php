@extends('layouts.master')

@push('styles')
@endpush

@section('title', 'Home')

@section('content')
    {{-- <search-component></search-component> --}}
    <pokemon-component></pokemon-component>
    {{-- <center><h1>{{ 'hi' }}</h1></center> --}}
@endsection


@section('script')

@endsection