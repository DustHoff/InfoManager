@extends("layout.master")
@section("content")
    @component("admin.Group.groupForm",["permissions"=>$group->permissions])
        @slot("url") {{route("updateGroup",compact("group"))}} @endslot
        @slot("name") {{$group->name}} @endslot
    @endcomponent
@endsection