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
                            <div class="col-sm-4 control-label">@lang("menu.name")</div>
                            <div class="col-sm-8">
                                @component("html.error",["field"=>"name"])
                                    <input class="form-control" type="text" id="name" name="name"
                                           value="{{$user->name}}">
                                @endcomponent
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">@lang("menu.username")</div>
                            <div class="col-sm-8">
                                @component("html.error",["field"=>"username"])
                                    <input class="form-control" type="text" id="username" name="username"
                                           value="{{$user->username}}">
                                @endcomponent
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">@lang("menu.email")</div>
                            <div class="col-sm-8">
                                @component("html.error",["field"=>"email"])
                                    <input class="form-control" type="text" id="email" name="email"
                                           value="{{$user->email->email}}">
                                @endcomponent
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">@lang("menu.password")</div>
                            <div class="col-sm-8">
                                @component("html.error",["field"=>"password"])
                                    <input class="form-control" type="password" id="password" name="password">
                                @endcomponent
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">@lang("menu.confirmation")</div>
                            <div class="col-sm-8">
                                @component("html.error",["field"=>"password_confirmation"])
                                    <input class="form-control" type="password"
                                           name="password_confirmation">
                                @endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        @component("html.error",["field"=>"group"])
                            <select id="group" name="group[]" class="form-control" style="height: auto" multiple>
                                <option value="">None</option>
                                @foreach(\App\Group::all() as $group)
                                    <option value="{{$group->id}}"
                                            @if($user->groups->contains($group))selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        @endcomponent
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