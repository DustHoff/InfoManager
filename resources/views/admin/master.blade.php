@extends("layout.master")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Users</a>
        </li>
        <li role="presentation"><a href="#group" aria-controls="group" role="tab" data-toggle="tab">Groups</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="user">
            @include("admin.user.all")
        </div>
    </div>
@endsection