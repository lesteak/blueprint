@php
    $location_id = "6302ddec1f85c122836a5703";
@endphp
@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->title }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

    <timetable :active-location-id="'{{ $location_id }}'"></timetable>

@endsection
