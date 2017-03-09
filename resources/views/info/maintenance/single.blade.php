@extends("layout.master")
@section("content")
    <form method="post" action="{{route("commentMaintenance",compact("maintenance"))}}">
        {{ csrf_field() }}
        @include("layout.error")
        <div class="row">
            @component("info.maintenance.headerinfo")
            @slot("title")
            {{$maintenance->state}} {{ $maintenance->type }}
            @endslot
            Start {{$maintenance->maintenance_start}}
            @if($maintenance->maintenance_end!=null)
                End {{$maintenance->maintenance_end}}
            @endif
            @endcomponent
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
                @php
                    $comments = $maintenance->comments()->paginate(10);
                @endphp
                {{ $comments->links() }}
                @foreach($comments as $comment)
                    @component("info.Maintenance.comment")
                        @slot("user")
                            {{$comment->user->name}}
                        @endslot
                        @slot("date")
                            {{$comment->created_at}}
                        @endslot
                        {{$comment->body}}
                    @endcomponent
                @endforeach
                {{ $comments->links() }}
            </div>
            <div class="col-lg-4">
                <div class="list-group">
                    @foreach($maintenance->infected as $maintainable)
                        @component("info.Maintainable.item")
                        @slot("url"){{route("maintainable",compact("maintainable"))}}@endslot
                        {{$maintainable->name}}
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection