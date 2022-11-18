@extends('layouts.app')

@section('content')

    <h1 class="sr-only">{{ $page->name }}</h1>

    @flexibleField($trainer, 'content', 'content')

    @flexibleField($page, 'content', 'content')

@endsection
