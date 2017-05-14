@component("email.component.layout")

    @slot("header")
        {{ __("maintenance.".$maintenance->type) }} {{__("maintenance.".$maintenance->state)}}
        @lang("maintenance.from",["start"=>$maintenance->maintenance_start])
        @if($maintenance->maintenance_end!=null)
            @lang("maintenance.till",["end"=>$maintenance->maintenance_end])
        @endif

        @if($maintenance->rootcause != null)
            @if($maintenance->rootcause != $maintainable->id)
                <br>
                @lang("maintenance.causedBy",["system" => $maintenance->causedBy->name])
            @endif
        @endif
    @endslot

    {{ $header }}

    @foreach($maintenance->comments as $comment)
        @component("email.component.comment")
            {{$comment->body}}
        @endcomponent
    @endforeach

    {{ $footer }}

    @slot("footer")
        @component("email.component.footer")
            {{ config('app.name') }}. <a
                    href="{{route("maintenance",compact("maintenance"))}}">view in Browser</a>
        @endcomponent
    @endslot

@endcomponent
