@extends("layout.master")

@section("content")

    {{$maintainables->links()}}
    <div class="list-group">
    @foreach($maintainables as $maintainable)
        @include("info.maintainable.item")
    @endforeach
    </div>
    {{$maintainables->links()}}
@endsection