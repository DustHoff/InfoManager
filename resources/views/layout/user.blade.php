<li class="dropdown">
    <a href="#" class="dropdown-toggle" type="button" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        {{\Illuminate\Support\Facades\Auth::user()->username}}
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="userMenu">
        <li><a href="{{route("profile",["user"=>\Illuminate\Support\Facades\Auth::user()])}}">Pofile</a></li>
        <li><a href="{{route("admin")}}">Administration</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="{{route("logout")}}">Logout</a></li>
    </ul>
</li>