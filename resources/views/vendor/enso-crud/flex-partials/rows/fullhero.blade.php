@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'fullhero'
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
   *   ->desktop_image - ImageFile|null
   *   ->mobile_image - ImageFile|null
   *   ->title - string
   *
   * Note that if mobile_image isn't defined on the row but desktop_image is,
   * the row unpacking process will have already copied the desktop_image to
   * the mobile_image property.
   */
  $row_data = \App\Crud\Rows\FullHeroRow::unpack($row);
@endphp
