@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $location->name }}</h1>

    @flexibleField($location, 'content', 'content')

    @flexibleField($page, 'content', 'content')

@endsection
