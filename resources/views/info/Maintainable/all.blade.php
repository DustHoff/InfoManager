@extends("layout.master")
@section("content")
    {{$maintainables->links()}}
    <div class="list-group">
        <div class="list-group-item">
            @can("administrate",\App\Application::class)
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#add-application">@lang("menu.create",["thing"=>__("maintainable.Application")])</button>
            @endcan
            @can("administrate",\App\Host::class)
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#add-host">@lang("menu.create",["thing"=>__("maintainable.Host")])</button>
            @endcan
        </div>
        @foreach($maintainables as $maintainable)
            @can("view",$maintainable)
                @component("info.Maintainable.item",compact("maintainable"))
                @endcomponent
            @endcan
        @endforeach
        <?php unset($maintainable); ?>
    </div>
    {{$maintainables->links()}}
@endsection
@section("footer")
    @can("administrate",\App\Application::class)
        @include("popup.application-popup")
    @endcan
    @can("administrate",\App\Host::class)
        @include("popup.host-popup")
    @endcan
    <script>
        $(window.location.hash).modal('show');
    </script>
@endsection