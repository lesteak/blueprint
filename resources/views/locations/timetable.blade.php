@php
    /**
     * @var \Illuminate\Database\Eloquent\Collection $all_locations
     * @var \App\Models\Location                     $location
     * @var \App\Models\Page                         $page
     */
    //dd($page, $location, $all_locations);
@endphp
@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->title }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

    <timetable
        :active-location='@json($location)'
        :locations='@json($all_locations)'
    ></timetable>

@endsection
