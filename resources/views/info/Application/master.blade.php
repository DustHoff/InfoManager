@extends("layout.master")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="information" role="tab"
                                                  data-toggle="tab">@lang("menu.info")</a>
        </li>
        @can("schedule",$maintainable)
            <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab"
                                       data-toggle="tab">@lang("menu.schedule")</a>
            </li>
        @endcan
        <li role="presentation"><a href="#components" aria-controls="components" role="tab"
                                   data-toggle="tab">@lang("menu.dependency")</a></li>
        @can("delete",$maintainable)
            <li role="presentation"><a href="{{route("deleteMaintainable",$maintainable)}}">@lang("menu.delete")</a>
            </li>
        @endcan
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            @component("info.Maintainable.info")
                @slot("url") {{route("updateApplication",["application" => $maintainable->maintainable])}} @endslot
                @slot("name") {{$maintainable->name}} @endslot
                @slot("desc") {{$maintainable->desc}} @endslot
                @slot("type") {{$maintainable->maintainable_type}} @endslot
                @slot("host"){{$maintainable->maintainable->host_id}}@endslot
                @slot("monitoring")
                    @foreach(\App\Monitoring\Monitor::getList() as $monitoringitem)
                        <option value="{{$monitoringitem->identifier()}}" )
                                @if($maintainable->monitoring_id == $monitoringitem->identifier()) selected @endif>{{$monitoringitem->name()}}</option>
                    @endforeach
                @endslot
                @slot("contacts")
                    @foreach($maintainable->emails as $email)
                        <option value="{{$email->email}}">{{$email->email}}</option>
                    @endforeach
                @endslot
                    @slot("maintainablegroup")
                        @foreach($maintainable->maintainablegroups as $maintainablegroup)
                            <option value="{{$maintainablegroup->name}}">{{$maintainablegroup->name}}</option>
                        @endforeach
                    @endslot
            @endcomponent
        </div>
        @can("schedule",$maintainable)
            <div role="tabpanel" class="tab-pane" id="schedule">
                @component("info.Maintenance.schedule",["id"=>$maintainable->id])
                    @slot("infected")
                        <div class="list-group">
                            <div class="list-group-item">@lang("menu.infectedsystems")</div>
                            @foreach($maintainable->infect() as $infectable)
                                @component("info.Maintainable.item")
                                    @slot("url") {{route("maintainable",["maintainable"=>$infectable])}} @endslot
                                    {{Maintainable::find($infectable)->name}}
                                @endcomponent
                            @endforeach
                        </div>
                        <input type="hidden" id="maintainable_id" name="maintainable[]"
                               value="{{$maintainable->id}}">
                        <input type="hidden" id="maintainable_id" name="rootcause"
                               value="{{$maintainable->id}}">
                    @endslot
                    @foreach($maintainable->maintenances as $maintenance)
                        @include("info.Maintenance.item")
                    @endforeach
                @endcomponent
            </div>
        @endcan
        <div role="tabpanel" class="tab-pane" id="components">@include("info.Application.components")</div>
    </div>
@endsection
