@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->title }}</h1>

    @flexibleField($page, 'header', 'header')

    @include('pages.partials.classes-trainers-timetable-subnav')

    @flexibleField($page, 'content', 'content')

@endsection
