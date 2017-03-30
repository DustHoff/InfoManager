<a href="{{route("maintenance",compact("maintenance"))}}" class="list-group-item">
    <h4 class="list-group-item-heading"><span
                class="label label-info">{{__("maintenance.".$maintenance->type)}}</span> @lang("maintenance.from",["start"=>$maintenance->maintenance_start])
        @if($maintenance->maintenance_end!=null)
            @lang("maintenance.till",["end"=>$maintenance->maintenance_end])
        @endif
    </h4>
    <p class="list-group-item-text">
        {{Illuminate\Mail\Markdown::parse($maintenance->comments->first()->body)}}
    </p>
</a>
