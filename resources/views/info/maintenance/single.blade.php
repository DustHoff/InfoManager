@extends("layout.master")
@section("content")
    <form method="post" action="{{route("commentMaintenance",compact("maintenance"))}}">
        {{ csrf_field() }}
        @include("layout.error")
        <div class="row">
            <div class="col-lg-5">
                <img src="/img/icon/{{$maintenance->type}}.png">{{$maintenance->maintenance_start->format(env("timestamp_format"))}}
                @if($maintenance->maintenance_end!=null)
                    {{$maintenance->maintenance_end->format(env("timestamp_format"))}}
                @endif
            </div>
            <div class="col-lg-3">{{$maintenance->state}}</div>
            <div class="col-lg-4">
                @if($maintenance->state!="inactive")
                    <a href="{{route("maintenanceTransit",compact("maintenance"))}}">
                        <span class="btn btn-primary">
                    @if($maintenance->state=="active")
                                Close
                            @else
                                start
                            @endif
                            </span></a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                @if($maintenance->state!="inactive")
                    <div class="panel panel-default">
                        <div class="panel-heading"><input type="submit" value="comment" class="btn btn-primary"></div>
                        <div class="panel-body">
                            <textarea name="body" class="form-control"></textarea>
                        </div>
                    </div>
                @endif
                <?php $comments = $maintenance->comments()->paginate(10); ?>
                {{ $comments->links() }}
                @foreach($comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$comment->user->name}} wrote {{$comment->created_at->diffForHumans()}}</div>
                        <div class="panel-body">
                            {{$comment->body}}
                        </div>
                    </div>
                @endforeach
                {{ $comments->links() }}
            </div>
            <div class="col-lg-4">
                <div class="list-group">
                    @foreach($maintenance->infected as $maintainable)
                        <a href="{{route("maintainable",compact("maintainable"))}}" class="list-group-item">{{$maintainable->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection