@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'text'
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
   *   ->title - string
   */
  $row_data = $row->unpack();
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
@endphp

<section
  id="{{ $row_data->row_id }}"
  class="my-10 p-10"
>
  <div class="max-w-2xl m-auto flex w-full flex-col">
    <h2 class="text-8xl">{{ $row_data->title }}</h2>
    {!! $row_data->content !!}
  </div>
</section>