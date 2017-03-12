@extends("layout.master")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#info" aria-controls="information" role="tab" data-toggle="tab">Information</a>
        </li>
        <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">Schedule</a>
        </li>
        <li role="presentation"><a href="#components" aria-controls="components" role="tab"
                                   data-toggle="tab">Application Dependencies</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="info">
            @component("info.Maintainable.info")
            @slot("url") {{route("updateApplication",["application" => $maintainable->maintainable])}} @endslot
            @slot("name") {{$maintainable->name}} @endslot
            @slot("desc") {{$maintainable->desc}} @endslot
            @slot("type") {{$maintainable->maintainable_type}} @endslot
            @slot("host"){{$maintainable->maintainable->host_id}}@endslot
            @endslot
            @slot("contacts")
            @foreach($maintainable->emails as $email)
                <option value="{{$email->email}}">{{$email->email}}</option>
            @endforeach
            @endcomponent
        </div>
        <div role="tabpanel" class="tab-pane" id="schedule">@include("info.Maintainable.schedule")</div>
        <div role="tabpanel" class="tab-pane" id="components">@include("info.Application.components")</div>
    </div>
@endsection