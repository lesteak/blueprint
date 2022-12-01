@php
  /**
   * $row_data consists of:
   *   ->row_label - string - Not relevant for current use-case
   *   ->row_id - string - for anchor tags in case they want to link with a # value
   *   ->row_type - string - 'textvideo'
   *   ->alignment, string - left|right
   *   ->buttons, Collection - items which consist of:
   *     ->button_components - array of true\false options: ['pointy']
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
   $row_data = $row->unpack();
   //dd($row_data);
   $row_id = $row_data->row_id ? $row_data->row_id : $id_prefix . '-' . $row_index;
 @endphp
 
 <section id="{{ $row_data->row_id }}" class="max-w-screen-2xl m-auto mt-20 p-10">
   <div class="flex flex-col justify-center gap-20">
       <div
         class="
           flex
           flex-col
           bg-brand-grey-500
           {{ $row_data->alignment == 'left' ? 'md:flex-row' : 'md:flex-row-reverse' }}
         "
       >
         @if ($row_data->video)
         <div class="relative aspect-video">
            @include('enso-fields::video-embed', [
              'video' => $row_data->video,
            ])
          </div>
         @endif
         <div class="flex flex-col justify-center p-10 md:p-20 w-full">
           <h2 class="text-white text-8xl">{{ $row_data->title }}</h2>
           {!! $row_data->content !!}
           <x-button-group :buttons="$row_data->buttons" class="mt-8"></x-button-group>
         </div>
       </div>
   </div>
 </section>
 