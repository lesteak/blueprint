@php
$footer_locations = \Yadda\Enso\SiteMenus\Facades\SiteMenu::get('footer-locations');
$footer_more = \Yadda\Enso\SiteMenus\Facades\SiteMenu::get('footer-menu');

$menus = new \Illuminate\Support\Collection([$footer_locations, $footer_more]);

@endphp

<footer>

  @include('parts.locations-footer')

  <div
    class="
      flex
      flex-col
      bg-gradient-to-r
      from-[#25272e]
      to-brand-grey-500
      text-brand-grey-100
    "
  >
    <section class="max-w-7xl m-auto flex w-full gap-20 py-20 px-5 flex-col md:flex-row">
      <div class="flex justify-center md:block">
        <img
          src="{{ asset('img/logo-crest.webp') }}"
          srcset="
            {{ asset('img/logo-crest@2x.webp') }} 2x,
            {{ asset('img/logo-crest@3x.webp') }} 3x,
          "
          alt="{{ config('app.name') }}"
        >
      </div>

      <nav class="flex w-full gap-20 flex-col md:flex-row">
        @foreach ($menus as $menu)
          @if ($menu && $menu->items->isNotEmpty())
            <ul class="border-t md:border-l md:border-t-0 border-brand-grey-500 pt-4 md:pl-4">
              <li class="text-white text-4xl font-teko">{{ $menu->title }}</li>
              @foreach ($menu->items as $item)
                <li><a href="{{ $item->url }}" target="{{ $item->target }}">{{ $item->label }}</a></li>
              @endforeach
            </ul>
          @endif
        @endforeach

        @if (EnsoSettings::get('instagram_url') || EnsoSettings::get('facebook_url') || EnsoSettings::get('twitter_url'))
          <ul class="border-t md:border-l md:border-t-0 border-brand-grey-500 pt-4 md:pl-4">
            <li class="text-white text-4xl font-teko">Social</li>
            @if (EnsoSettings::get('instagram_url'))
              <li><a href="{{ EnsoSettings::get('instagram_url') }}">instagram</a></li>
            @endif
            @if (EnsoSettings::get('facebook_url'))
              <li><a href="{{ EnsoSettings::get('facebook_url') }}">facebook</a></li>
            @endif
            @if (EnsoSettings::get('twitter_url'))
            <li><a href="{{ EnsoSettings::get('twitter_url') }}">twitter</a></li>
          @endif
          </ul>
        @endif
      </nav>
    </section>

    <section class="bg-brand-grey-500 py-5 text-center text-[#636363] flex justify-center flex-col md:flex-row">
      <p>This website and its content is copyright of www.blueprintmartialarts.com</p> - © Blueprint Martial Arts 2022.
      All rights reserved.
    </section>
  </div>
</footer>