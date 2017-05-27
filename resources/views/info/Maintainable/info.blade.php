<form method="post" action="{{$url}}" class="form-horizontal">
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.name")</div>
        <div class="col-sm-10">
            <input id="name" name="name" value="{{$maintainable->name or ''}}" class="form-control">
            @if($errors->get("name"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("name") as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.description")</div>
        <div class="col-sm-10">
            <textarea id="desc" name="desc" class="form-control">{{$maintainable->desc or ''}}</textarea>
            @if($errors->get("desc"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("desc") as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.contact")</div>
        <div class="col-sm-10">
            <select id="contacts" data-role="tagsinput" name="emails[]" multiple>
                @if(isset($maintainable))
                    @foreach($maintainable->emails as $email)
                        <option value="{{$email->email}}">{{$email->email}}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->get("emails.*"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("emails.*") as $error)
                            {!! var_dump($error) !!}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($type == "Application")
    @elseif($type == "Host")
        <div class="form-group">
            <div class="control-label col-sm-2">Stage</div>
            <div class="col-sm-10">
                <select id="stage" name="stage" class="form-control">
                    @foreach(\App\Host::STAGE as $stage)
                        <option
                                @if(isset($maintainable))
                                @if($maintainable->maintainable->stage==$stage) selected
                                @endif value="{{$stage}}"
                                @endif>{{$stage}}</option>

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
                       value="{{$maintainable->maintainable->owner or ''}}">
            </div>
        </div>
    @endif
    <div class="form-group">
        <div class="col-sm-2 control-label">@lang("maintainable.group")</div>
        <div class="col-sm-10">
            <select id="maintainablegroup" data-role="tagsinput" name="maintainablegroups[]" multiple>
                @if(isset($maintainable))
                    @foreach($maintainable->maintainablegroups as $maintainablegroup)
                        <option value="{{$maintainablegroup->name}}">{{$maintainablegroup->name}}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->get("maintainablegroup.*"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("emails.*") as $error)
                            {!! var_dump($error) !!}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <div class="control-label">@lang("maintainable.runson")</div>
        </div>
        <div class="col-sm-10">
            <select class="form-control" name="host_id">
                <option value="">Physical Machine</option>
                @foreach(\App\Host::all() as $host)
                    <option value="{{$host->id}}"
                            @if(isset($maintainable))
                            @if("$host->id" == $maintainable->maintainable->host_id) selected @endif
                            @endif>{{$host->maintainable->name}}</option>
                @endforeach
            </select>
            @if($errors->get("host_id"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("host_id") as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.monitoring")</div>
        <div class="col-sm-10">
            <div class="input-group">
                <select name="monitoring" class="form-control">
                    <option value="">None</option>
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