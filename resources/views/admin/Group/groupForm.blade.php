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
            <select class="form-control" name="permissions[]" multiple>
                @foreach(\App\Permission::all() as $permission)
                    <option value="{{$permission->id}}"
                            @if($permissions->contains($permission)) selected @endif>{{$permission->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success">
        </div>
    </div>
</form>