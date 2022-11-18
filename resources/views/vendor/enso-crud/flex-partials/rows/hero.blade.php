@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'hero'
   *   ->desktop_image - ImageFile|null
   *   ->mobile_image - ImageFile|null
   *   ->title - string
   *
   * Note that if mobile_image isn't defined on the row but desktop_image is,
   * the row unpacking process will have already copied the desktop_image to
   * the mobile_image property.
   */
  $row_data = $row->unpack();
@endphp
