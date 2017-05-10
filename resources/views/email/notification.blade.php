@component("email.component.layout")

    @slot("header")
        {{ __("maintenance.".$maintenance->type) }} {{__("maintenance.".$maintenance->state)}}
        @lang("maintenance.from",["start"=>$maintenance->maintenance_start])
        @if($maintenance->maintenance_end!=null)
            @lang("maintenance.till",["end"=>$maintenance->maintenance_end])
        @endif

        @if($maintenance->rootcause != $maintainable->id)
            <br>
            @lang("maintenance.causedBy",["system" => $maintenance->causedBy->name])
        @endif
    @endslot

    @foreach($maintenance->comments as $comment)
        @component("email.component.comment")
            @slot("user")
                {{$comment->user->name}}
            @endslot
            @slot("date")
                {{$comment->created_at}}
            @endslot
            {{$comment->body}}
        @endcomponent
    @endforeach

    @slot("footer")
        @component("email.component.footer")
            {{ config('app.name') }}. <a
                    href="{{route("maintenance",compact("maintenance"))}}">view in Browser</a>
        @endcomponent
    @endslot

@endcomponent
