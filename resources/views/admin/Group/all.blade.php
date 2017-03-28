@include("admin.Group.groupForm")
<div class="list-group">
    @foreach(\App\Group::all() as $group)
        <a href="{{route("group",compact("group"))}}" class="list-group-item">{{$group->name}} <span class="badge">{{count($group->members)}}
                Member</span> </a>
    @endforeach
</div>