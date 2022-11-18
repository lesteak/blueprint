@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'textvideo'
   *   ->alignment, string - left|right
   *   ->buttons, Collection - items which consist of:
   *     ->label - string
   *     ->hover - string - if not set, use the label as the hover tooltip
   *     ->link - string
   *     ->target - string
   *     ->rel - string
   *   ->content - string - HTML
   *   ->image - ImageFile|null
   *   ->title - string
   *   ->video - array which consists of:
   *     ->canonical_url - string
   *     ->id - string - video id
   *     ->optoins - array
   *     ->type - string - vimeo|youtube
   */
  $row_data = \App\Crud\Rows\TextVideoRow::unpack($row);
@endphp
