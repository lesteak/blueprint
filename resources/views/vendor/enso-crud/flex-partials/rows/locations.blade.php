@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - locations
   *   ->class - ClassModel|null
   *   ->title - string
   *   ->trainer - Trainer|null
   */
  $row_data = $row->unpack();
  //dd($row_data);
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
@endphp

<section id="{{ $row_id }}" class="max-w-screen-2xl m-auto p-10">
  <h2 class="text-5xl md:text-8xl">{{ $row_data->title }}</h2>
  <location-index
    :classType='@json($row_data->class)'
    :trainer='@json($row_data->trainer)'
  ></location-index>
</section>
