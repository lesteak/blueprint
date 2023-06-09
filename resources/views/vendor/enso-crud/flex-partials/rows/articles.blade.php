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
  $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
  @endphp
  
<section id="{{ $row_id }}" class="max-w-screen-2xl m-auto md:p-10 p-5 mt-20">
  <div class="mb-10">
    <h2 class="text-5xl md:text-8xl">{{ $row_data->title }}</h2>
    <div class="[&>p]:text-black [&>p]:text-lg mb-10">
      {!! $row_data->content !!}
    </div>

    @if ($row_data->articles->count() > 0)
      <article-index :preloaded_articles='@json($row_data->articles)' :more_content="'{{ $row_data->more_content }}'"></article-index>
    @endif
  </div>

</section>