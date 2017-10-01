@can("view",$maintainable)
    <a href="{{route("maintainable",compact("maintainable"))}}" class="list-group-item">
        <h4 class="list-group-item-heading">{{$maintainable->name}}</h4>
        <p class="list-group-item-text"><span
                    class="label label-info">{{__("maintainable.".$maintainable->maintainable_type)}}</span></p>
    </a>
@endcan