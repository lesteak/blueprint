@php
$menu = SiteMenu::get('main-menu');
$is_burger = $menu && $menu->items->count() > $menu->max_visible_items;
@endphp

<main-menu v-slot="{menuVisible,toggleMenu}">
  <div id="nav-bar" class="w-full flex text-white justify-between fixed z-50">
    <div class="flex absolute h-28 z-30">
      <div
        class="
          flex
          justify-center
          items-center
          bg-brand-blue
          h-[60px]
          md:h-[100px]
          w-[155px]
          md:w-[292px]
          z-20
          md:px-10
          px-4
        "
      >
        <a href="{{ url('/') }}">
          <img
            class="p-3.5 md:p-0"
            src="{{ asset('svg/logo.svg') }}"
            alt="{{ config('app.name') }}"
          >
        </a>
      </div>
      <div class="
        triangle
        w-10
        h-[100px]
        absolute
        right-[-1.8rem]
        md:right-[-3.1rem]
        z-20
        "
      ></div>    
    </div>
    <nav
      class="
        bg-gradient-to-r
        from-[#25272e]
        to-brand-grey-500
        flex
        w-full
        justify-end
        font-medium
        h-[50px]
        md:h-[80px]
      "
    >
      @if ($menu)
      @if(!$is_burger)
        <ul class="mx-10 hidden lg:grid grid-cols-4">
          @foreach ($menu->items as $item)
            <li
              class="
                w-full
                h-full
                text-white
                {{ Nav::isCurrent($item->url) ? 'border-t-4 border-[#4e8fdf]' : '' }}
                border-r
                border-r-black/30
                first:border-l
                first:border-l-black/30
              "
            >
              <a
                href="{{ $item->url }}"
                target="{{ $item->target_str }}"
                rel="{{ $item->rel }}"
                class="
                  h-full
                  items-center
                  flex
                  justify-center
                  px-5
                "
              >
                {{ $item->label }}
              </a>
            </li>
          @endforeach
        </ul>
      @endif
      <button
        :class="{'is-active': menuVisible}"
        class="hamburger hamburger--squeeze {{ $is_burger ? '' : 'lg:hidden' }} px-5 z-50"
        @click="toggleMenu"
        type="button"
      >
        <span class="hamburger-box">
          <span class="hamburger-inner bg-white"></span>
        </span>
      </button>
      @endif

      <div
        id="mobile-nav"
        :class="{hidden: !menuVisible}"
        class="
          bg-gradient-to-r
          from-[#25272e]
          to-brand-grey-500
          absolute
          left-0
          h-screen
          w-full
          z-20
          flex
          flex-col
          justify-around
          items-center
          pt-20
        "
      >
        <ul class="w-full flex flex-col justify-center items-center">
          @if ($menu)
            @foreach ($menu->items as $item)
              <li class="border-black last:border-b border-t w-full text-center py-10">
                <a
                  href="{{ $item->url }}"
                  target="{{ $item->target_str }}"
                  rel="{{ $item->rel }}"
                >
                  {{ $item->label }}
                </a>
              </li>
            @endforeach
          @endif
        </ul>

        <ul class="text-center">
          @if (EnsoSettings::get('instagram_url') || EnsoSettings::get('facebook_url') || EnsoSettings::get('twitter_url'))
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
          @endif
        </ul>
      </div>
    </nav>
  </div>
</main-menu>