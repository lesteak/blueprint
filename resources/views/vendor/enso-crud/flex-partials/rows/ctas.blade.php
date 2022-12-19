@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'ctas'
   *   ->ctas, Collection - items which consist of:
   *     ->row_label - string - Not relevant for current use-case
   *     ->row_id - string - for anchor tags in case they want to link with a # value
   *     ->row_type - string - 'cta'
   *     ->buttons, Collection - should only be one button, to use as the source
   *                             of the link for this CTA. Consist of:
   *       ->row_label - string - Not relevant for current use-case
   *       ->row_id - string - for anchor tags in case they want to link with a # value
   *       ->row_type - string - 'button'
   *       ->button_components - array of true\false options: ['pointy']
   *       ->label - string
   *       ->hover - string
   *       ->link - string
   *       ->target - string
   *       ->rel - string
   *     ->image - ImageFile|null
   *     ->title - string
   *   ->title - string
   */
  $row_data = $row->unpack();
@endphp
