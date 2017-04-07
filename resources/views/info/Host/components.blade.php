<div class="list-group">
    @can("administrate",\App\Application::class)
        <div class="list-group-item">
            <button type="button" class="btn btn-success" data-toggle="modal"
                    data-target="#add-application">@lang("menu.add",["thing"=>__("maintainable.Application")])</button>
        </div>
    @endcan
    @foreach($maintainable->maintainable->applications as $application)
        <a href="{{route("maintainable",["maintainable"=>$application->maintainable])}}"
           class="list-group-item">{{$application->maintainable->name}}</a>
    @endforeach
    @if($maintainable->maintainable->host_id == null)
        @can("administrate",\App\Host::class)
            <div class="list-group-item">
                <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#add-host">@lang("menu.add",["thing"=>__("maintainable.Host")])</button>
            </div>
        @endcan
        @foreach($maintainable->maintainable->vms as $vm)
            <a href="{{route("maintainable",$vm->maintainable->id)}}"
               class="list-group-item">{{$vm->maintainable->name}}</a>
        @endforeach
    @endif
</div>
@can("administrate",\App\Application::class)
    @include("popup.application-popup")
@endcan
@can("administrate",\App\Host::class)
    @include("popup.host-popup")
@endcan