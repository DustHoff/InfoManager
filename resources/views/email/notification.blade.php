@component("mail::layout")

@slot("header")
@component("email.component.mailrow")

@component("info.maintenance.headerinfo")
        @slot("title")
            {{$maintenance->state}} {{ $maintenance->type }}
        @endslot
        Start {{$maintenance->maintenance_start}}
        @if($maintenance->maintenance_end!=null)
            End {{$maintenance->maintenance_end}}
        @endif
    @endcomponent
@endcomponent
@endslot

@component("email.component.mailrow")
@foreach($maintenance->comments as $comment)
    @component("info.Maintenance.comment")
    @slot("user")
    {{$comment->user->name}}
    @endslot
    @slot("date")
    {{$comment->created_at}}
    @endslot
    {{$comment->body}}
    @endcomponent
@endforeach
@endcomponent

@slot("footer")
@component("email.component.footer")
{{ date('Y') }} {{ config('app.name') }}. All rights reserved. <a href="{{route("maintenanceMessage",compact("maintenance"))}}">view in Browser</a>
@endcomponent
@endslot

@endcomponent
