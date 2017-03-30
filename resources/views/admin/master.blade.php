@extends("layout.master")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" @if("$panel"=="user") class="active" @endif><a href="#user" aria-controls="user"
                                                                               role="tab"
                                                                               data-toggle="tab">@lang("menu.user")</a>
        </li>
        <li role="presentation" @if("$panel"=="group") class="active" @endif><a href="#group" aria-controls="group"
                                                                                role="tab"
                                                                                data-toggle="tab">@lang("menu.group")</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane @if("$panel"=="user")active @endif" id="user">
            @include("admin.User.all")
        </div>
        <div role="tabpanel" class="tab-pane @if("$panel"=="group")active @endif" id="group">
            @include("admin.Group.all")
        </div>
    </div>
@endsection
