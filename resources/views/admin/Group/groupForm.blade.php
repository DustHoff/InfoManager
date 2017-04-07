<form class="form-horizontal" method="post" action="{{route("storeGroup")}}">
    <div class="form-group">
        <div class="control-label col-sm-2">Name</div>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" value="{{$name or ''}}">
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
            <input type="submit" class="btn btn-success" value="@lang("menu.save")">
        </div>
    </div>
</form>