@php
    $cards = [];
    if (EnsoSettings::get('more_links_trainers_url'))
    {
        $cards[] = [
            "name" => EnsoSettings::get('more_links_trainers_title'),
            "img" => collect(EnsoSettings::get('more_links_trainers_image'))->first(),
            "url" => EnsoSettings::get('more_links_trainers_url')
        ];
    }
    if (EnsoSettings::get('more_links_classes_url'))
    {
        $cards[] = [
            "name" => EnsoSettings::get('more_links_classes_title'),
            "img" => collect(EnsoSettings::get('more_links_classes_image'))->first(),
            "url" => EnsoSettings::get('more_links_classes_url')
        ];
    }
    if (EnsoSettings::get('more_links_timetable_url'))
    {
        $cards[] = [
            "name" => EnsoSettings::get('more_links_timetable_title'),
            "img" => collect(EnsoSettings::get('more_links_timetable_image'))->first(),
            "url" => EnsoSettings::get('more_links_timetable_url')
        ];
    }
@endphp
@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->name }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

    <section class="max-w-screen-2xl m-auto md:p-10 p-5">
        <h2 class="text-5xl md:text-8xl">More</h2>
        <more-links :cards='@json($cards)'></more-links>
    </section>

@endsection
