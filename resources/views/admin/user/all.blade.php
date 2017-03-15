@include("admin.user.formUser")
{{$users->links()}}
<div class="list-group">
    @foreach($users as $user)
        <a href="{{route("profile",compact("user"))}}" class="list-group-item">{{$user->name}}</a>
    @endforeach
</div>