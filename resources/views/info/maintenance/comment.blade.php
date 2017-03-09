<div class="panel panel-default">
    <div class="panel-heading">
        {{$user or 'System'}} {{$date}}
    </div>
    <div class="panel-body">
        {{Illuminate\Mail\Markdown::parse($slot)}}
    </div>
</div>