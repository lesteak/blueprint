@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->name }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

    <section class="max-w-screen-2xl m-auto p-10">
        <h2>More</h2>
        <more-links></more-links>
    </section>

@endsection
