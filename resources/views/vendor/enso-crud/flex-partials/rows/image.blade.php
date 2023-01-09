@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'carousel'
   *   ->image - ImageFile|null
   */
  $row_data = $row->unpack();
  //dd($row_data);
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
@endphp

<section id="{{ $row_data->row_id }}" class="max-w-screen-2xl m-auto mt-20">
  @if ($row_data->image)
    <picture class="w-full">
      <img
        class="w-full h-auto object-cover"
        src="{{ $row_data->image->getResizeUrl('480_x', true) }}"
        alt="{{ $row_data->image->alt_text }}"
      >
    </picture>
  @endif
</section>