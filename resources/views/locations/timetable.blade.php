@php
    $location_id = "6302ddec1f85c122836a5703";
    //dd($page, $location);
@endphp
@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->title }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

    <timetable :active-location-id="'{{ $location->glowfox_id }}'" :trainer-id="'629869e2c1426b6fc81d00c7'"></timetable>

@endsection
