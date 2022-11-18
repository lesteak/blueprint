@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'features'
   *   ->background - string - 'light|dark'
   *   ->divider - array of true false options - ['bottom']
   *   ->features, Collection - items which consist of:
   *     ->row_label - string - Not relevant for current use-case
   *     ->row_id - string - for anchor tags in case they want to link with a # value
   *     ->row_type - string - 'feature'
   *     ->alignment - string - 'left|right'
   *     ->content - string - HTML
   *     ->image - ImageFile|null
   *     ->title - string
   *   ->title - string
   */
  $row_data = \App\Crud\Rows\FeaturesRow::unpack($row);
@endphp
