@include("admin.User.formUser")
<div class="list-group">
    @foreach(\App\User::all() as $user)
        <a href="{{route("profile",compact("user"))}}" class="list-group-item">{{$user->name}}</a>
    @endforeach
</div>
