<form method="post" action="{{route("updateHost",["host"=>$maintainable->maintainable])}}" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="control-label col-sm-2">Name</label>
        <div class="col-sm-10">
            <input name="name" value="{{$maintainable->name}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="stage" class="control-label col-sm-2">Stage</label>
        <div class="col-sm-10">
            <select name="stage" class="form-control">
                @foreach(\App\Host::STAGE as $stage)
                    <option @if($maintainable->maintainable->stage==$stage) selected
                            @endif value="{{$stage}}">{{$stage}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="owner" class="control-label col-sm-2">Owner</label>
        <div class="col-sm-10">
            <input name="owner" class="form-control col-sm-10" value="{{$maintainable->maintainable->owner}}">
        </div>
    </div>
    <div class="form-group">
        <label for="contacts" class="control-label col-sm-2">Contact</label>
        <div class="col-sm-10">
            <select id="contacts" data-role="tagsinput" name="emails[]" multiple>
                @foreach($maintainable->emails as $email)
                    <option value="{{$email->email}}">{{$email->email}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group" class="control-label col-sm-2">
        <label class="control-label col-sm-2">Applications</label>
        <div class=" col-sm-10">{{$maintainable->maintainable->applications->count()}}</div>
    </div>
    <div class="form-group">
        <label for="zabbix_id" class="control-label col-sm-2">Zabbix Host ID</label>
        <div class="col-sm-10">
            <input name="zabbix_id" class="form-control" value="{{$maintainable->maintainable->zabbix_id}}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            {{csrf_field()}}
            <input type="hidden" name="maintainable_type" value="{{$maintainable->maintainable_type}}">
            <input type="hidden" name="host_id" value="{{$maintainable->maintainable->host_id}}">
        </div>
        <div class="col-sm-10">
            <input type="submit" value="save" class="btn btn-success">
        </div>
    </div>
    @include("layout.error")
</form>