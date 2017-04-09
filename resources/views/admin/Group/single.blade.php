@extends("layout.master")
@section("content")
    @component("admin.Group.groupForm",["permissions"=>$group->maintainableMembers])
        @slot("url") {{route("updateGroup",compact("group"))}} @endslot
        @slot("name") {{$group->name}} @endslot
        @if($group->isAdmin())
            @slot("admin") checked @endslot
        @endif
        @if($group->editor)
            @slot("editor") checked @endslot
        @endif
        @if($group->schedule)
            @slot("schedule") checked @endslot
        @endif
    @endcomponent
@endsection