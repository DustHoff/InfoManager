@extends("layout.master")
@section("content")
    <form method="post" action="{{route("login")}}">
        <div class="panel panel-danger" style="width:500px;margin: 0 auto">
            <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
            </div>
            <div class="panel-body">
                <label for="username">Username</label><input id="username" type="text" name="name"><br>
                <label for="password">Password</label><input id="password" type="password" name="password"><br>
                {{csrf_field()}}
                <button type="submit" class="btn btn-success">Login</button>
                @include("layout.error")
            </div>
        </div>
    </form>
@endsection