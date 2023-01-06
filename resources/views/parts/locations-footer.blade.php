@php
$button = null;
if (EnsoSettings::get('location_footer_button'))
{
  $buttons = collect(EnsoSettings::get('location_footer_button'))->first();
  $button = (object) [
    "link" => $buttons['fields']['link']['content'],
    "target" => $buttons['fields']['target']['content']['id'],
    "hover" => $buttons['fields']['hover']['content'],
    "label" => $buttons['fields']['label']['content'],
  ];
}
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
        @if ($button)
          <a
              href="{{ $button->link }}"
              target="{{ $button->target }}"
              class="button sign-post"
              title="{{ $button->hover }}"
          >
              <span>{{ $button->label }}</span>
          </a>
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
          src="{{ $image['url'] }}"
          alt="Our Locations">
        @endif
    </div>
  </section>