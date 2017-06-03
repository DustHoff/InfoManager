@extends("layout.master")

@section("content")

    <div class="list-group">
        @foreach($maintainables as $maintainable)
            @can("view",$maintainable)
                @component("info.Maintainable.item",compact("maintainable"))
                @endcomponent
            @endcan
        @endforeach
    </div>
@endsection
