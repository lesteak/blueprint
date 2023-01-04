@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'carousel'
   *   ->images, Collection of ImageFile
   *   ->title - string
   */
  $row_data = $row->unpack();
  $images = [];
  foreach ($row_data->images as $image) {
    $images[] = $image->getResizeUrl('hero_lg', true);
  }
@endphp

<section>
  <carousel
    class="
      md:max-w-screen-2xl
      max-w-full
      m-auto
      flex
      flex-col
      justify-center
      h-full
      mt-20
      md:p-10
      px-0
      py-10
      h-[480px]
    "
    :slides='@json($images)'
  ></carousel>
</section>
