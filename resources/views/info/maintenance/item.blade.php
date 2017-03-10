<a href="{{route("maintenance",compact("maintenance"))}}" class="list-group-item">
    <h4 class="list-group-item-heading"><span class="label label-info">{{$maintenance->type}}</span> from {{$maintenance->maintenance_start}}
        @if($maintenance->maintenance_end != null)
            to {{$maintenance->maintenance_end}}
        @endif
    </h4>
    <p class="list-group-item-text">
        {{$maintenance->comments->first()->body}}
    </p>
</a>
