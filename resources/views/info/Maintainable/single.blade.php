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
            @if(\Illuminate\Support\Facades\View::exists("info.".$maintainable->maintainable_type.".info"))
                @component("info.".$maintainable->maintainable_type.".info",[
                "url"=>route("update".$maintainable->maintainable_type,[strtolower($maintainable->maintainable_type) => $maintainable->maintainable]),
                "type"=>$maintainable->maintainable_type,
                "maintainable"=>$maintainable,
                "selectHost"=>$maintainable->maintainable->host_id])
                @endcomponent
            @else
                @component("info.Maintainable.info",[
                "url"=>route("update".$maintainable->maintainable_type,[strtolower($maintainable->maintainable_type) => $maintainable->maintainable]),
                "type"=>$maintainable->maintainable_type,
                "maintainable"=>$maintainable,
                "selectHost"=>$maintainable->maintainable->host_id])
                @endcomponent
            @endif

        </div>
        @can("schedule",$maintainable)
            <div role="tabpanel" class="tab-pane" id="schedule">
                @component("info.Maintenance.schedule",compact("maintainable"))
                @endcomponent
            </div>
        @endcan
        <div role="tabpanel" class="tab-pane"
             id="components">@include("info.".$maintainable->maintainable_type.".components")</div>
    </div>
@endsection
@section('footer')
    <script>
        $('a[href="' + window.location.hash + '"]').tab('show');
    </script>
@endsection