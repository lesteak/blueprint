@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'quote'
   *   ->quote - string - HTML
   *   ->source - string
   *   ->title - string
   */
  $row_data = $row->unpack();
  //dd($row_data);
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
@endphp

<section
  id="{{ $row_data->row_id }}"
  class="my-10 md:p-10 p-5"
>
  <div class="max-w-2xl m-auto flex w-full flex-col">
    <h2 class="text-5xl md:text-8xl">{{ $row_data->title }}</h2>
    <div class="border-l-4 border-brand-blue">
      <blockquote class="text-4xl px-9 [&>p]:text-brand-grey-500">
        {!! $row_data->quote !!}
      </blockquote>
      @if ($row_data->source)
        <p class="text-right text-brand-grey-500 mt-10">— {{ $row_data->source }} </p>
      @endif
    </div>
  </div>
</section>