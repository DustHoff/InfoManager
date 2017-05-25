@component("email.component.layout")

    @slot("header")
        {{ __("maintenance.".$maintenance->type) }} {{__("maintenance.".$maintenance->state)}}
        @lang("maintenance.from",["start"=>$maintenance->maintenance_start])
        @if($maintenance->maintenance_end!=null)
            @lang("maintenance.till",["end"=>$maintenance->maintenance_end])
        @endif
    @endslot

    {{ Illuminate\Mail\Markdown::parse($header) }}

    @foreach($maintenance->comments as $comment)
        @component("email.component.comment")
            {{$comment->body}}
        @endcomponent
    @endforeach

    {{ Illuminate\Mail\Markdown::parse($footer) }}

    @slot("footer")
        @component("email.component.footer")
            {{ config('app.name') }}. <a
                    href="{{route("maintenance",compact("maintenance"))}}">view in Browser</a>
        @endcomponent
    @endslot

@endcomponent
