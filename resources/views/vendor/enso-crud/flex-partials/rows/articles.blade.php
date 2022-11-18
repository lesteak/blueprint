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
@endphp
