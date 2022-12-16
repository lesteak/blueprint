@php
    // Sorry
    $all_locations = EnsoCrud::query('location')
        ->orderBy('name', 'asc')
        ->get();
@endphp
<enquiry-button :locations='@json($all_locations)'></enquiry-button>