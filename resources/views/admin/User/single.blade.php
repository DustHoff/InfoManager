@extends("layout.master")
@section("content")
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Profile</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="{{route("updateUser",compact("user"))}}" class="form-horizontal">
                <div class="row">
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Name</div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Username</div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="username" value="{{$user->username}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Password</div>
                            <div class="col-sm-8"><input class="form-control" type="password" name="password"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">retype Password</div>
                            <div class="col-sm-8"><input class="form-control" type="password"
                                                         name="password_confirmation"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <select name="group[]" class="form-control" style="height: auto" multiple>
                            <option value="">None</option>
                            @foreach(\App\Group::all() as $group)
                                <option value="{{$group->id}}"
                                        @if($user->groups->contains($group))selected @endif>{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-8 col-sm-4">
                        {{ csrf_field() }}
                        <input type="submit" name="action" value="@lang("menu.save")" class="btn btn-success">
                        <input type="submit" name="action" value="@lang("menu.delete")" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection