@php
  //dd($location);
@endphp
@extends('layouts.app')

@section('content')
<div>
    <h1 class="sr-only">{{ $location->name }}</h1>

    <div
    id="hero"
    class="
      bg-brand-grey-200
      text-white
      relative
      mb-20
      pt-20
      md:pt-5
    "
  >
    <div
      id="hero-content"
      class="
        relative
        z-10
        flex
        flex-col-reverse
        justify-center
        max-w-screen-2xl
        m-auto
        py-40
        p-5
        md:flex-row
        gap-5
        pt-20
        md:pt-40
      "
    >
      <div class="md:w-6/12 w-full flex justify-center md:justify-start flex-col h-auto gap-5">
        <div class="flex flex-col gap-5 px-5 border-b border-b-black/30">
          <h1 class="text-5xl md:text-8xl">{{ $location->name }}</h1>
          @if ($location->role)
            <p class="text-white text-base font-cabin tracking-widest uppercase pb-10">{{ $location->role }}</p>
          @endif

          @if ($location->description)
            <div class="[&>p]:text-brand-grey-100 mb-10 text-lg">
              {!! $location->description !!}
            </div>
          @endif
        </div>

        <ul class="flex flex-col gap-10 mt-10 md:mt-20">
          @if ($location->address)
          <li class="flex gap-5">
            <div class="bg-brand-grey-500 w-10 h-10 flex justify-center items-center aspect-square">
              <img class="p-2.5" src="{{ asset('svg/icon-address.svg') }}" alt="Address Icon">
            </div>
            <dl>
              <dt>address</dt>
              <dd><address class="not-italic">{{ $location->address }}</address></dd>
            </dl>
          </li>
          @endif
          @if ($location->email)
          <li class="flex gap-5">
            <div class="bg-brand-grey-500 w-10 h-10 flex justify-center items-center aspect-square">
              <img class="p-2.5" src="{{ asset('svg/icon-email.svg') }}" alt="Email Icon">
            </div>
            <dl>
              <dt>email</dt>
              <dd>{{ $location->email }}</dd>
            </dl>
          </li>
          @endif
          @if ($location->phone)
          <li class="flex gap-5">
            <div class="bg-brand-grey-500 w-10 h-10 flex justify-center items-center aspect-square">
              <img class="p-2.5" src="{{ asset('svg/icon-phone.svg') }}" alt="Phone Icon">
            </div>
            <dl>
              <dt>Whatsapp</dt>
              <dd><a href="https://wa.me/{{ str_replace(' ', '', $location->phone) }}">{{ $location->phone }}</a></dd>
            </dl>
          </li>
          @endif
        </ul>

      </div>

      <div class="w-full md:w-6/12 flex justify-center aspect-square">
        @if ($location->heroImage)
          <img
            class="max-h-[720px] max-w-[640px] w-full h-auto object-contain aspect-square"
            src="{{ $location->heroImage->getResizeUrl('trainer_location_hero', true) }}"
            alt="Entrance of Setia City Mall location"
          >
        @endif
        {{--  <map-element :geo='@json($location->geo)'></map-element>  --}}
      </div>
    </div>

    <div
      class="
        bg-brand-blue
        absolute
        right-0
        h-1/6
        w-full
        top-0
        md:h-full
        md:w-4/12
      "
    ></div>

    <div id="hero-divider" class="w-full absolute bottom-[-2rem]">
      <svg
        class="h-[70px] md:h-auto w-full"
        viewBox="0 0 1920 120"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g fill="none" fill-rule="evenodd">
            <path fill="#141519" d="m0 0 1920 120H0z"/>
            <path fill="#FFF" d="M1920 0v120H0z"/>
        </g>
      </svg>        
    </div>
    </div>

    @flexibleField($location, 'content', 'content')

    @flexibleField($page, 'content', 'content')

@endsection
