<form class="form-horizontal" method="post" action="{{$url or route("storeGroup")}}">
    <div class="form-group">
        <div class="control-label col-sm-2">Name</div>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="{{$name or ''}}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <label class="control-label">Admin<input name="admin" type="checkbox" value="1" {{$admin or ''}}
                class="checkbox-inline"></label>
            <label class="control-label">Editor<input name="editor" type="checkbox" value="1" {{$editor or ''}}
                class="checkbox-inline"></label>
            <label class="control-label">@lang("menu.schedule")<input name="schedule" type="checkbox" value="1"
                                                                      {{$schedule or ''}}
                                                                      class="checkbox-inline"></label>
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">Permissions</div>
        <div class="col-sm-10">
            <select class="form-control" name="maintainablegroups[]" multiple>
                @foreach(\App\MaintainableGroup::all() as $maintainablegroup)
                    <option value="{{$maintainablegroup->id}}"
                            @if($permissions->contains($maintainablegroup)) selected @endif>{{$maintainablegroup->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success" value="@lang("menu.save")" name="action">
            @if(isset($name))
                <input type="submit" class="btn btn-danger" value="@lang("menu.delete")" name="action">
            @endif
        </div>
    </div>
</form>