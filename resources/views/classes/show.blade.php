@extends('layouts.app')

@php
$background_style = $class->heroImage
    ? 'background-image: url(' . $class->heroImage->getResizeUrl('hero', true) . ')'
    : "background-color:black";
@endphp

@section('content')

    <section id="class-hero">
        <div class="relative h-[480px] p-10 bg-center	bg-cover" style="{{ $background_style }}">
          <div class="max-w-screen-2xl m-auto flex flex-col justify-center h-full">
            <div class="w-full text-center">
              <h1 class="text-10xl text-white">{{ $class->name }}</h1>
            </div>
          </div>
        </div>
    </section>

    @flexibleField($class, 'content', 'content')

    @flexibleField($page, 'content', 'content')

@endsection
