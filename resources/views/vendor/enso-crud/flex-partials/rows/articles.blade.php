@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'articles'
   *   ->articles, Collection of Post objects
   *   ->content - string - HTML
   *   ->limit - string - (numeric per page value)
   *   ->more_content - string - "none|see_all|load_more"
   *   ->title - string
   */
  $row_data = $row->unpack();
  //dd($row_data);
@endphp

<section id="{{ $row_data->row_id }}" class="p-10">
  <div>
    <h2>{{ $row_data->title }}</h2>
    <div class="[&>p]:text-black">
      {!! $row_data->content !!}
    </div>

    @if ($row_data->articles->count() > 0)
    <article-index :articles='@json($row_data->articles)'></article-index>
    @else
      <p>No news is good news</p>
    @endif
  </div>
</section>