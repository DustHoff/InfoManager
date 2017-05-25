@extends("layout.master")
@section("content")
    <div class=" col-lg-offset-3 col-lg-6 col-xs-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="{{route("login")}}" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-4 control-label">@lang("menu.username")</div>
                        <div class="col-sm-8">
                            <input id="username" type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">@lang("menu.password")</div>
                        <div class="col-sm-8">
                            <input id="password" type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">{{csrf_field()}}</div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success" style="width: 100%">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection