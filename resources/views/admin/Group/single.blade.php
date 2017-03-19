@extends("layout.master")
@section("content")
    @component("admin.Group.groupForm")
        @slot("url") {{route("updateGroup",compact("group"))}} @endslot
        @slot("name") {{$group->name}} @endslot
        @slot('permissions')
            @foreach(\App\Permission::all() as $permission)
                <option value="{{$permission->id}}" @if($group->permissions->contains($permission)) selected @endif>{{$permission->name}}</option>
            @endforeach
        @endslot
    @endcomponent
@endsection