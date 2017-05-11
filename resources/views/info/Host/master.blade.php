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
                                   data-toggle="tab">@lang("menu.components")</a></li>
        @can("delete",$maintainable)
            <li role="presentation"><a href="{{route("deleteMaintainable",$maintainable)}}">@lang("menu.delete")</a>
            </li>
        @endcan
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            @component("info.Maintainable.info")
                @slot("url") {{route("updateHost",["host" => $maintainable->maintainable])}} @endslot
                @slot("name") {{$maintainable->name}} @endslot
                @slot("desc") {{$maintainable->desc}} @endslot
                @slot("monitoring")
                    @foreach(\App\Monitoring\Monitor::getList() as $monitoringitem)
                        <option value="{{$monitoringitem->identifier()}}" )
                                @if($maintainable->monitoring_id == $monitoringitem->identifier()) selected @endif>{{$monitoringitem->name()}}</option>
                    @endforeach
                @endslot
                @slot("type") {{$maintainable->maintainable_type}} @endslot
                @slot("host"){{$maintainable->maintainable->host_id}}@endslot
                @slot("owner") {{$maintainable->maintainable->owner}} @endslot
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
                <div class="form-group">
                    <div class="control-label col-sm-2">Stage</div>
                    <div class="col-sm-10">
                        <select id="stage" name="stage" class="form-control">
                            @foreach(\App\Host::STAGE as $stage)
                                <option @if($maintainable->maintainable->stage==$stage) selected
                                        @endif value="{{$stage}}">{{$stage}}</option>
                            @endforeach
                        </select>
                        @if($errors->get("stage"))
                            <div class="tooltip bottom" style="opacity: 1">
                                <div class="tooltip-arrow"></div>
                                <div class="tooltip-inner">
                                    @foreach($errors->get("stage") as $error)
                                        {{$error}}<br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="control-label col-sm-2">Owner</div>
                    <div class="col-sm-10">
                        <input name="owner" class="form-control col-sm-10"
                               value="{{$maintainable->maintainable->owner}}">
                    </div>
                </div>
                <div class="form-group" class="control-label col-sm-2">
                    <div class="control-label col-sm-2">Applications</div>
                    <div class=" col-sm-10">{{$maintainable->maintainable->applications->count()}}</div>
                </div>
            @endcomponent
        </div>
        @can("schedule",$maintainable)
            <div role="tabpanel" class="tab-pane" id="schedule">
                @component("info.Maintenance.schedule")
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
        <div role="tabpanel" class="tab-pane" id="components">@include("info.Host.components")</div>
    </div>
@endsection

@section('footer')
    <script>
        $('a[href="' + window.location.hash + '"]').tab('show');
    </script>
@endsection