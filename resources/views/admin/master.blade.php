@extends("layout.master")
@section("content")

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#user" aria-controls="user"
                                                  role="tab"
                                                  data-toggle="tab">@lang("menu.user")</a>
        </li>
        <li role="presentation"><a href="#group" aria-controls="group"
                                   role="tab"
                                   data-toggle="tab">@lang("menu.group")</a>
        </li>
        <li role="presentation"><a href="#options" aria-controls="option" role="tab"
                                   data-toggle="tab">@lang("menu.option")</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="user">
            @can("administrate",\App\User::class)
                @include("admin.User.all")
            @endcan
        </div>
        <div role="tabpanel" class="tab-pane" id="group">
            @can("administrate",\App\Group::class)
                @include("admin.Group.all")
            @endcan
        </div>
        <div role="tabpanel" class="tab-pane" id="options">
            @can("administrate",\App\Option::class)
                @include("admin.options")
            @endcan
        </div>
    </div>
@endsection
