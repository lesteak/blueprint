@extends('layouts.app')

@section('content')
  <div>
    <h1 class="sr-only">{{ $trainer->name }}</h1>

    <div
    id="hero"
    class="
      bg-brand-grey-200
      text-white
      relative
      mb-20
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
        md:py-40
        p-5
        md:flex-row
        md:justify-between
        gap-5
        pt-10
        md:pt-40
      "
    >
      <div class="md:w-6/12 w-full flex justify-center md:justify-between flex-col h-auto gap-5">
        <div class="flex flex-col gap-5 px-5 border-b border-b-black/30">
          <h1 class="text-5xl md:text-8xl">{{ $trainer->name }}</h1>
          @if ($trainer->role)
            <p class="text-white text-base font-cabin tracking-widest uppercase pb-10">{{ $trainer->role }}</p>
          @endif

          @if ($trainer->description)
          <div class="[&>p]:text-brand-grey-100 mb-10 text-lg">
            {!! $trainer->description !!}
          </div>
          @endif
        </div>
      </div>

      <div class="w-full md:w-6/12 flex justify-center aspect-square">
        <img
          class="max-h-[720px] max-w-[640px] w-full h-auto object-contain aspect-square"
          src="{{ $trainer->heroImage->getResizeUrl('trainer_location_hero', true) }}"
          alt="Entrance of Setia City Mall location"
        >
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
  </div>

  @flexibleField($trainer, 'content', 'content')

  @flexibleField($page, 'content', 'content')

  <section class="max-w-screen-2xl m-auto p-10">
    <h2 class="text-5xl md:text-8xl">More</h2>
    <more-links :hide="'/classes'"></more-links>
  </section>
@endsection
