@component('mail::message')
# New Enquiry

**Email**: [{{ $newsletter->email }}](mailto:{{ $newsletter->email }})

@if (!empty($newsletter->data))
@foreach ($newsletter->data as $key => $value)
@if ($key == 'branch' && !empty($value))
@php
$branch = \Yadda\Enso\Facades\EnsoCrud::query('location')->where('slug', $value)->first()
@endphp
**Branch:** {{ $branch ? $branch->name : 'None Specified' }}
@else
**{{ ucwords(implode(' ', explode('_', $key))) }}:** {{ $value }}
@endif

@endforeach
@endif
@endcomponent
