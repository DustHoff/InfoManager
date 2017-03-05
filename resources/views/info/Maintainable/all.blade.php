@extends("layout.master")
@section("content")
    {{$maintainables->links()}}
    <div class="list-group">
        <div class="list-group-item">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-application">create
                Application
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-host">create Host
            </button>
        </div>
        @foreach($maintainables as $maintainable)
            @include("info.maintainable.item")
        @endforeach
    </div>
    {{$maintainables->links()}}
@endsection
@section("footer")
    @include("popup.application-popup")
    @include("popup.host-popup")
@endsection