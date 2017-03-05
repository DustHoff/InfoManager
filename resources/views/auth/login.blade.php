@extends("layout.master")
@section("content")
    <div class="panel panel-danger">
        <form method="post" action="{{route("login")}}">
            <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
            </div>
            <div class="panel-body">
                <label for="username">Username</label><input id="username" type="text" name="name"><br>
                <label for="password">Password</label><input id="password" type="password" name="password">
                <div class="panel-footer">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
                @include("layout.error")
            </div>
        </form>
    </div>
@endsection