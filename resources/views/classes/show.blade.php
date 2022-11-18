@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $class->name }}</h1>

    @flexibleField($class, 'content', 'content')

    @flexibleField($page, 'content', 'content')

@endsection
