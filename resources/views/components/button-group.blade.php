@props([
    'buttons' => collect([]),
    'wrapperClass' => 'flex gap-2 md:gap-5 md:flex-wrap',
    'color' => null,
    'hoverColor' => null,
])


@if ($buttons->isNotEmpty())
    <div {{ $attributes->merge(['class' => $wrapperClass]) }}>
        @foreach ($buttons as $button)
        @php
            $pointy = in_array("pointy", $button->button_components);
        @endphp

            @if($button->row_type === 'enquirybutton')
                @include('vendor.enso-crud.flex-partials.rows.enquirybutton')
            @else
                <a
                    href="{{ $button->link }}"
                    @if ($button->rel)
                    rel="{{ $button->rel }}"
                    @endif
                    target="{{ $button->target }}"
                    class="button {{ $pointy ? 'sign-post' : ''}}"
                    title="{{ $button->hover }}"
                >
                    <span>{{ $button->label }}</span>
                </a>
            @endif
        @endforeach
    </div>
@endif
