<form method="post" action="{{$url}}" class="form-horizontal">
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.name")</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"name"])
                <input id="name" name="name" value="{{$maintainable->name or ''}}" class="form-control">
            @endcomponent
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.description")</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"desc"])
                <textarea id="desc" name="desc" class="form-control">{{$maintainable->desc or ''}}</textarea>
            @endcomponent
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.contact")</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"emails"])
                <select id="emails" name="emails[]" multiple>
                    @if(isset($maintainable))
                        @foreach($maintainable->emails as $email)
                            <option value="{{$email->email}}">{{$email->email}}</option>
                        @endforeach
                    @endif
                </select>
            @endcomponent
        </div>
    </div>
    {{$slot or ''}}
    <div class="form-group">
        <div class="col-sm-2 control-label">@lang("maintainable.group")</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"maintainablegroups"])
                <select id="maintainablegroups" data-role="tagsinput" name="maintainablegroups[]" multiple>
                    @if(isset($maintainable))
                        @foreach($maintainable->maintainablegroups as $maintainablegroup)
                            <option value="{{$maintainablegroup->name}}">{{$maintainablegroup->name}}</option>
                        @endforeach
                    @endif
                </select>
            @endcomponent
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <div class="control-label">@lang("maintainable.runson")</div>
        </div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"host_id"])
                <select id="host_id" class="form-control" name="host_id">
                    <option value="">@lang("menu.physical_machine")</option>
                    @foreach(\App\Maintainable::query()->where("maintainable_type","=","Host")->orderBy("name")->get() as $host)
                        <option value="{{$host->maintainable->id}}"
                                @if(isset($selectHost))
                                @if($host->maintainable->id == $selectHost) selected @endif
                                @endif>{{$host->name}}</option>
                    @endforeach
                </select>
            @endcomponent
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.monitoring")</div>
        <div class="col-sm-10">
            <div class="input-group">
                @component("html.error",["field"=>"monitoring"])
                    <select id="monitoring" name="monitoring" class="form-control">
                        <option value="">@lang("menu.none")</option>
                        @foreach(\App\Monitoring\Monitor::getList() as $monitoringitem)
                            <option value="{{$monitoringitem->identifier()}}"
                                    @if(isset($maintainable))
                                    @if($maintainable->monitoring_id == $monitoringitem->identifier()) selected @endif
                                    @endif>{{$monitoringitem->name()}}</option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <button class="btn glyphicon glyphicon-refresh" type="button"
                            onclick="$.get('{{route("clearCache")}}');location.reload()"></button>
                    </span>
                @endcomponent
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            {{csrf_field()}}
            <input type="hidden" name="maintainable_type" value="{{$type}}">
        </div>
        <div class="col-sm-10">
            <input type="submit" value="@lang("menu.save")" class="btn btn-success">
        </div>
    </div>
</form>
