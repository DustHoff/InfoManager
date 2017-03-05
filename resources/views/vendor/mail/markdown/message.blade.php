@component('mail::layout',["maintenance"=>$maintenance])
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => route("maintenance",["maintenance"=>$maintenance->id])])
{{$maintenance->state}} {{ $maintenance->type }} Start {{$maintenance->maintenance_start}}
@if($maintenance->maintenance_end!=null)
    End {{$maintenance->maintenance_end}}
@endif
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@if (isset($subcopy))
    @slot('subcopy')
    @component('mail::subcopy')
    {{ $subcopy }}
    @endcomponent
    @endslot
@endif

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent
