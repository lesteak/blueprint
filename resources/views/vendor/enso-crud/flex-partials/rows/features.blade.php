@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'features'
   *   ->background - string - 'light|dark'
   *   ->divider - array of true false options - ['bottom']
   *   ->features, Collection - items which consist of:
   *     ->row_label - string - Not relevant for current use-case
   *     ->row_id - string - for anchor tags in case they want to link with a # value
   *     ->row_type - string - 'feature'
   *     ->alignment - string - 'left|right'
   *     ->content - string - HTML
   *     ->image - ImageFile|null
   *     ->title - string
   *   ->title - string
   */
  $row_data = $row->unpack();
  //dd($row_data);
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
@endphp

<section id="{{ $row_data->row_id }}" class="{{ $row_data->background == 'dark' ? 'bg-brand-grey-200' : 'bg-white' }}">
  <div class="max-w-screen-2xl m-auto flex flex-col justify-center gap-20 py-20">
    @foreach($row_data->features as $feature)
      <div
        class="
          flex
          flex-col
          bg-brand-grey-500
          {{ $feature->alignment == 'left' ? 'md:flex-row' : 'md:flex-row-reverse' }}
        "
      >
        @if ($feature->image)
          <picture class="w-full md:max-w-[480px]">
            <img
              class="w-full h-auto md:w-[480px] md:h-[480px]"
              src="{{ $feature->image->getResizeUrl('480_x', true) }}"
              alt="{{ $feature->image->alt_text }}"
            >
          </picture>
        @endif
        <div class="flex flex-col justify-center p-10 md:p-20 w-full">
          <h2 class="text-white text-8xl">{{ $feature->title }}</h2>
          {!! $feature->content !!}
          <x-button-group :buttons="$feature->buttons" class="mt-8"></x-button-group>
        </div>
      </div>
    @endforeach
  </div>

  @if($row_data->divider["bottom"])
    <div class="rotate-180 mb-20">
      <x-divider></x-divider>
    </div>
  @endif
</section>
