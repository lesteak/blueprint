@php
$button = collect(EnsoSettings::get('location_footer_button'));
$image = collect(EnsoSettings::get('location_footer_image'))->first();
@endphp
<section class="max-w-screen-2xl m-auto p-10 my-20 flex w-full flex-col">
    <div
      class="
        grid
        grid-cols-1
        md:grid-cols-3
        bg-gradient-to-r
        from-[#25272e]
        to-brand-grey-500
        text-white
      "
    >
      <div
        class="
          col-span-2
          flex
          flex-col
          justify-center
          gap-10
          md:p-20
          p-10
          order-2
          md:order-1
        "
      >
        <h2>{{ EnsoSettings::get('location_footer_title') }}</h2>
        {{ EnsoSettings::get('location_footer_content') }}
        @if (EnsoSettings::get('location_footer_button'))
          {{--  <x-button-group :buttons="$button" class="mt-8"></x-button-group>  --}}
        @endif
      </div>
      @if ($image)
        <img
          class="
            order-1
            md:order-2
            h-full
            object-cover
            w-full
          "
          src="{{ $image['preview'] }}"
          alt="Our Locations">
        @endif
    </div>
  </section>