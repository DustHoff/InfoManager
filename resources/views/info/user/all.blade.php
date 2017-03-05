@extends("layout.master")
@section("content")
    @include("info.user.formUser")
    {{$users->links()}}
    <div class="list-group">
        @foreach($users as $user)
            <a href="{{route("user",compact("user"))}}" class="list-group-item">{{$user->name}}</a>
        @endforeach
    </div>
@endsection