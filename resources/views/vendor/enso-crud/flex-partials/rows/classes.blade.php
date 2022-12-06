@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - classes
   *   ->group_by_category - boolean
   *   ->location - Location|null
   *   ->title - string
   *   ->trainer - Trainer|null
   */
  $row_data = $row->unpack();
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
  $category_group = $row_data->group_by_category ? 1 : 0;
@endphp

<section id="{{ $row_id }}" class="max-w-screen-2xl m-auto p-10">
  <h2 class="text-8xl">{{ $row_data->title }}</h2>
  <classes-index
    :category_group="{{ $category_group }}"
    :location='@json($row_data->location)'
    :trainer='@json($row_data->trainer)'
  ></classes-index>
</section>
