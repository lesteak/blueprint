@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'hero'
   *   ->desktop_image - ImageFile|null
   *   ->mobile_image - ImageFile|null
   *   ->title - string
   *
   * Note that if mobile_image isn't defined on the row but desktop_image is,
   * the row unpacking process will have already copied the desktop_image to
   * the mobile_image property.
   */
  $row_data = $row->unpack();
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;

  $background_style = $row_data->desktop_image
    ? 'background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url(' . $row_data->desktop_image->getResizeUrl('hero', true) . '); background-position:center;background-size:cover;'
    : "background-color:black";
@endphp

<section id="{{ $row_data->row_id }}">
  <div class="relative h-[480px] p-10 bg-center	bg-cover" style="{{ $background_style }}">
    <div class="max-w-screen-2xl m-auto flex flex-col justify-center h-full">
      <div class="w-full text-center">
        <h1 class="text-8xl md:text-10xl text-white">{{ $row_data->title }}</h1>
      </div>
    </div>
  </div>
</section>