<div class="list-group">
    <div class="list-group-item">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-application">add
            Application
        </button>
    </div>
    @foreach($maintainable->maintainable->applications as $application)
        <a href="{{route("maintainable",["maintainable"=>$application->maintainable])}}"
           class="list-group-item">{{$application->maintainable->name}}</a>
    @endforeach
    @if($maintainable->maintainable->host_id == null)
        <div class="list-group-item">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-host">add VM</button>
        </div>
        @foreach($maintainable->maintainable->vms as $vm)
            <a href="{{route("maintainable",$vm->maintainable->id)}}"
               class="list-group-item">{{$vm->maintainable->name}}</a>
        @endforeach
    @endif
</div>
@include("popup.application-popup")
@include("popup.host-popup")