@extends("layout.master")

@section("content")

    {{$maintainables->links()}}
    <div class="list-group">
        @foreach($maintainables->sortBy("maintainable_type") as $maintainable)
            @can("view",$maintainable)
                @component("info.Maintainable.item",compact("maintainable"))
                @endcomponent
            @endcan
        @endforeach
    </div>
    {{$maintainables->links()}}
@endsection
