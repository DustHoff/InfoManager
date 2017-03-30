<div class="panel panel-danger">
    <form method="post" action="{{route("storeUser")}}">
        <div class="panel-body">
            <label for="name">Name</label><input id="name" name="name" type="text">
            <label for="username">Username</label><input id="username" type="text" name="username">
            <label for="password">Password</label><input id="password" type="password" name="password">
            <label for="password_confirmation">Conformation</label><input id="password_confirmation" type="password"
                                                                          name="password_confirmation">
            {{csrf_field()}}
            <input type="submit" class="btn btn-success" value="@lang("menu.save")" name="action">
            @include("layout.error")
        </div>
    </form>
</div>