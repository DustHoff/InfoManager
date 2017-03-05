<div class="panel panel-danger">
    <form method="post" action="{{route("storeUser")}}">
        <div class="panel-body">
            <label for="username">Username</label><input id="username" type="text" name="name">
            <label for="password">Password</label><input id="password" type="password" name="password">
            <label for="password_confirmation">Conformation</label><input id="password_confirmation" type="password" name="password_confirmation">
                {{csrf_field()}}
                <button type="submit" class="btn btn-success">create</button>
        </div>
    </form>
</div>