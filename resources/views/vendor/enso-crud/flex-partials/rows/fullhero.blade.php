@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'fullhero'
   *   ->buttons, Collection - items which consist of:
   *     ->row_label - string - Not relevant for current use-case
   *     ->row_id - string - for anchor tags in case they want to link with a # value
   *     ->row_type - string - 'button'
   *     ->button_components - array of true\false options: ['pointy']
   *     ->label - string
   *     ->hover - string - if not set, use the label as the hover tooltip
   *     ->link - string
   *     ->target - string
   *     ->rel - string
   *   ->content - string - HTML
   *   ->desktop_image - ImageFile|null
   *   ->mobile_image - ImageFile|null
   *   ->title - string
   *
   * Note that if mobile_image isn't defined on the row but desktop_image is,
   * the row unpacking process will have already copied the desktop_image to
   * the mobile_image property.
   */
  $row_data = $row->unpack();
  //dd($row_data);
  $background_style = $row_data->desktop_image
    ? 'background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url(' . $row_data->desktop_image->getResizeUrl('hero_lg', true) . '); background-position:center;background-size:cover;'
    : "bg-red-500";
@endphp

<section id="{{ $row_data->row_id }}">
  <div class="relative h-screen p-10 bg-center bg-cover" style="{{ $background_style }}">
    <div class="max-w-screen-2xl m-auto flex flex-col justify-center h-full">
      <div class="w-full lg:w-1/2">
        <h1 class="text-white text-7xl md:text-10xl pr-4">{{ $row_data->title }}</h1>
        <div class="[&>P]:text-brand-grey-100 [&>P]:text-lg">
          {!! $row_data->content !!}
        </div>
        <x-button-group :buttons="$row_data->buttons" class="mt-8"></x-button-group>
      </div>
      <div class="w-full lg:w-1/2">
        <img src="{{ $row_data->desktop_image }}" alt="">
      </div>
    </div>

    <x-divider></x-divider>
  </div>
</section>