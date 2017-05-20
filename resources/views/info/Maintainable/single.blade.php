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
                                   data-toggle="tab">@lang("menu.".$maintainable->maintainable_type."_component")</a>
        </li>
        @can("delete",$maintainable)
            <li role="presentation"><a href="{{route("deleteMaintainable",$maintainable)}}">@lang("menu.delete")</a>
            </li>
        @endcan
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            @component("info.Maintainable.info",[
            "url"=>route("updateApplication",["application" => $maintainable->maintainable]),
            "type"=>$maintainable->maintainable_type,
            "maintainable"=>$maintainable])
            @endcomponent
        </div>
        @can("schedule",$maintainable)
            <div role="tabpanel" class="tab-pane" id="schedule">
                @component("info.Maintenance.schedule",["id"=>$maintainable->id])
                    @slot("infected")
                        <div class="list-group">
                            <div class="list-group-item">@lang("menu.infectedsystems")</div>
                            @foreach($maintainable->infect() as $infectable)
                                @component("info.Maintainable.item",["maintainable"=>\App\Maintainable::find($infectable)])
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
        <div role="tabpanel" class="tab-pane"
             id="components">@include("info.".$maintainable->maintainable_type.".components")</div>
    </div>
@endsection