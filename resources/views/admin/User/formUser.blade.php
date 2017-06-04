<div class="panel panel-danger">
    <div class="panel-body">
        <form method="post" action="{{route("storeUser")}}" class="form-inline">
            <div class="form-group">
                <div for="name" class="control-label">@lang("menu.name")</div>
                @component("html.error",["field"=>"name"])
                    <input id="name" name="name" type="text" class="form-control">
                @endcomponent
            </div>
            <div class="form-group">
                <div for="username" class="control-label">@lang("menu.username")</div>
                @component("html.error",["field"=>"username"])
                    <input id="username" type="text" name="username" class="form-control">
                @endcomponent
            </div>
            <div class="form-group">
                <div for="password" class="control-label">@lang("menu.password")</div>
                @component("html.error",["field"=>"password"])
                    <input id="password" type="password" name="password" class="form-control">
                @endcomponent
            </div>
            <div class="form-group">
                <div for="password_confirmation" class="control-label">@lang("menu.confirmation")</div>
                @component("html.error",["field"=>"password_confirmation"])
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                @endcomponent
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <input type="submit" class="btn btn-success" value="@lang("menu.save")" name="action">
            </div>
        </form>
    </div>
</div>