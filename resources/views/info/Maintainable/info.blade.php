<form method="post" action="{{$url}}" class="form-horizontal">
    <div class="form-group">
        <div class="control-label col-sm-2">@lang("maintainable.name")</div>
        <div class="col-sm-10">
            <input id="name" name="name" value="{{$name or ''}}" class="form-control">
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
            <textarea id="desc" name="desc" class="form-control">{{$desc or ''}}</textarea>
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
                {{$contacts or ''}}
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
    {{$slot}}
    <div class="form-group">
        <div class="col-sm-2 control-label">@lang("maintainable.group")</div>
        <div class="col-sm-10">
            <select id="maintainablegroup" data-role="tagsinput" name="maintainablegroups[]" multiple>
                {{$maintainablegroup or ''}}
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
                @foreach(\App\Host::all() as $value)
                    @if($name != $value->maintainable->name)
                        <option value="{{$value->id}}"
                                @if("$value->id" == $host) selected @endif>{{$value->maintainable->name}}</option>
                    @endif
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
            <select name="monitoring" class="form-control">
                <option value="">None</option>
                {{$monitoring or ''}}
            </select>
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