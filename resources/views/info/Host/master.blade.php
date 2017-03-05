@extends("layout.master")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="information" role="tab" data-toggle="tab">Information</a>
        </li>
        <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">Schedule</a>
        </li>
        <li role="presentation"><a href="#components" aria-controls="components" role="tab"
                                   data-toggle="tab">Components</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">@include("info.host.info")</div>
        <div role="tabpanel" class="tab-pane" id="schedule">@include("info.schedule")</div>
        <div role="tabpanel" class="tab-pane" id="components">@include("info.host.components")</div>
    </div>
@endsection