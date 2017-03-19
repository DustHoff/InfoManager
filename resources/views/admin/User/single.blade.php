@extends("layout.master")
@section("content")
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$user->name}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form method="post" action="{{route("updateUser",compact("user"))}}">
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">Password</div>
                            <div class="col-sm-8"><input class="form-control" type="password" name="password"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">retype Password</div>
                            <div class="col-sm-8"><input class="form-control" type="password"
                                                         name="password_confirmation"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control">
                            @foreach(\App\Group::all() as $group)
                                <option value="{{$group->id}}"
                                        @if($user->groups->contains($group))selected @endif>{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="list-group">
                <div class="list-group-item">Scheduled Maintenances/Incidents</div>
                @foreach($user->maintenances as $maintenance)
                    @include("info.Maintenance.item")
                @endforeach
            </div>
        </div>
    </div>
@endsection