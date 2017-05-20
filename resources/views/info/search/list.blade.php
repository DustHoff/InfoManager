@extends("layout.master")

@section("content")

    {{$maintainables->links()}}
    <div class="list-group">
        @foreach($maintainables as $maintainable)
            @can("view",$maintainable)
                @component("info.Maintainable.item",compact("maintainable"))
                @endcomponent
            @endcan
        @endforeach
    </div>
    {{$maintainables->links()}}
@endsection
