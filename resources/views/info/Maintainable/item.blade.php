<a href="{{$url or '#'}}" class="list-group-item">
    <h4 class="list-group-item-heading">{{$slot}}</h4>
    <p class="list-group-item-text">{{Illuminate\Mail\Markdown::parse($info)}}</p>
</a>