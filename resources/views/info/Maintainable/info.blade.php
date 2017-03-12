<form method="post" action="{{$url}}" class="form-horizontal">
    <div class="form-group">
        <div class="control-label col-sm-2">Name</div>
        <div class="col-sm-10">
            <input id="name" name="name" value="{{$name or ''}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">Description</div>
        <div class="col-sm-10">
            <textarea id="desc" name="desc" class="form-control">{{$desc or ''}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">Contact</div>
        <div class="col-sm-10">
            <select id="contacts" data-role="tagsinput" name="emails[]" multiple>
                {{$contacts or ''}}
            </select>
        </div>
    </div>
    {{$slot}}
    <div class="form-group">
        <div class="col-sm-2">
            <div class="control-label">Runs On</div>
        </div>
        <div class="col-sm-10">
            <select name="host_id">
                <option value="">No VM</option>
                @foreach(\App\Host::all() as $value)
                    @if($name != $value->maintainable->name)
                        <option value="{{$value->id}}"
                                @if("$value->id" == $host) selected @endif>{{$value->maintainable->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            {{csrf_field()}}
            <input type="hidden" name="maintainable_type" value="{{$type}}">
        </div>
        <div class="col-sm-10">
            <input type="submit" value="save" class="btn btn-success">
        </div>
    </div>
    @include("layout.error")
</form>