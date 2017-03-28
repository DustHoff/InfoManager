@extends("layout.master")

@section("content")

    {{$maintainables->links()}}
    <div class="list-group">
    @foreach($maintainables as $maintainable)
        @component("info.Maintainable.item")
            @slot("url"){{route("maintainable",compact("maintainable"))}}@endslot
            <span class="label label-info">{{__("maintainable.".$maintainable->maintainable_type)}}</span> {{$maintainable->name}}
        @endcomponent
    @endforeach
    </div>
    {{$maintainables->links()}}
@endsection
