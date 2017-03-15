<nav class="navbar navbar-inverse navbar-fixed-top">
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
                <li><a href="/maintainable">Systems</a></li>
                <li><a href="/maintenance">Maintenances</a></li>
                <li><a href="{{route("batchMaintenance")}}">Batch Schedule</a></li>
                @if(\Illuminate\Support\Facades\Auth::user())
                    @include("layout.user")
                @endif
            </ul>
            <form class="navbar-form navbar-right" method="post" action="{{route("search")}}">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" aria-describedby="searchButton"
                           placeholder="search ...">
                    <span id="searchButton" class="input-group-btn">
                    <button class="btn glyphicon glyphicon-search"
                            type="submit"></button>
                    </span>
                </div>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>