@php
    $menu = SiteMenu::get('sub-menu');
@endphp

@if ($menu)
    <section>
        <div
            class="
            w-full
            max-w-[100vw]
            bg-gradient-to-r
            from-[#25272e]
            to-brand-grey-500
            h-16
            flex
            justify-center
            "
        >
            <ul
            class="
                flex
                md:justify-center
                justify-between
                items-center
                h-full
                md:w-2/3
                lg:w-1/2
                xl:w-1/3
                w-full
            "
            >
            @foreach ($menu->items as $item)
            <li
                class="
                border-r
                first:border-l
                border-black
                w-full
                h-full
                {{ Nav::isCurrent($item->url) ? 'bg-white text-black md:rounded-tl-lg md:rounded-tr-lg' : 'text-white' }}
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
                    text-sm
                "
                >
                {{ $item->label }}
                </a>
            </li>
            @endforeach
            </ul>
        </div>
    </section>
@endif
