@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'carousel'
   *   ->image - ImageFile|null
   */
  $row_data = $row->unpack();
@endphp
