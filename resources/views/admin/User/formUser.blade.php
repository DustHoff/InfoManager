<div class="panel panel-danger">
    <div class="panel-body">
        <form method="post" action="{{route("storeUser")}}">
            <div class="form-group col-lg-3">
                <div for="name" class="control-label">@lang("menu.name")</div>
                <input id="name" name="name" type="text" class="form-control">
            </div>
            <div class="form-group col-lg-3">
                <div for="username" class="control-label">@lang("menu.username")</div>
                <input id="username" type="text" name="username" class="form-control">
            </div>
            <div class="form-group col-lg-2">
                <div for="password" class="control-label">@lang("menu.password")</div>
                <input id="password" type="password" name="password" class="form-control">
            </div>
            <div class="form-group col-lg-2">
                <div for="password_confirmation" class="control-label">@lang("menu.confirmation")</div>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group col-lg-2">
                {{csrf_field()}}
                <input type="submit" class="btn btn-success" value="@lang("menu.save")" name="action">
            </div>
        </form>
    </div>
</div>