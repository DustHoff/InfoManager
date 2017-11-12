<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">InfoManager</span>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route("allMaintainables")}}">@lang("menu.systems")</a></li>
                <li><a href="{{route("calendar")}}">@lang("menu.calendar")</a></li>
                <li><a href="{{route("batchMaintenance")}}">@lang("menu.batch") @lang("menu.schedule")</a></li>
                @if(\Illuminate\Support\Facades\Auth::user())
                    @include("layout.user")
                @endif
                <job-list url="{{route("jobs")}}"/>
            </ul>
            <form class="navbar-form navbar-right" method="post" action="{{route("search")}}">
                {{csrf_field()}}
                <autocomplete-search searchurl="{{route("maintainableAutocomplete")}}"
                                     refurl="{{route("allMaintainables")}}"></autocomplete-search>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>