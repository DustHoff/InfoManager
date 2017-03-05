@component("mail::layout")

    @slot("header")
        @component('mail::header', ['url' => route("maintenance",["maintenance"=>$maintenance->id])])
            {{$maintenance->state}} {{ $maintenance->type }} Start {{$maintenance->maintenance_start}}
            @if($maintenance->maintenance_end!=null)
                End {{$maintenance->maintenance_end}}
            @endif
        @endcomponent
    @endslot

    @foreach($maintenance->comments as $comment)
        {{$comment->created_at}} <br>
        {{$comment->body}} <br>
    @endforeach

    @slot("footer")
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved. <a href="{{route("maintenanceMessage",compact("maintenance"))}}">view in Browser</a>
        @endcomponent
    @endslot

@endcomponent
