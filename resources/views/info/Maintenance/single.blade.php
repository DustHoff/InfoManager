@extends("layout.master")
@section("content")
    <form method="post" action="{{route("commentMaintenance",compact("maintenance"))}}" class="form-horizontal">
        {{ csrf_field() }}
        @include("layout.error")
        <div class="row">
            @component("info.Maintenance.headerinfo")
                @slot("title")
                    {{__("maintenance.".$maintenance->state)}} {{ __("maintenance.".$maintenance->type) }}
                @endslot
                @lang("maintenance.from",["start"=>$maintenance->maintenance_start])
                @if($maintenance->maintenance_end!=null)
                    @lang("maintenance.till",["end"=>$maintenance->maintenance_end])
                @endif
            @endcomponent
        </div>
        <div class="row">
            <div class="col-lg-8">
                @can("change",$maintenance)
                    @if($maintenance->state!="inactive")
                        <div class="panel panel-default">
                            <div class="panel-heading">@lang("menu.status")</div>
                            <div class="panel-body">
                                <div class="col-sm-12 col-lg-3">
                                    <input type="submit" value="@lang("menu.comment")" class="btn btn-primary">
                                </div>
                                <div class="col-sm-12 col-lg-9">
                                    @if($maintenance->type==\App\Maintenance::TYPE[0])
                                        @component("html.error",["field"=>"maintenance_end"])
                                            <date-timepicker name="maintenance_end" placeholder="End"/>
                                        @endcomponent
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    @component("html.error",["field"=>"body"])
                                        <textarea id="body" name="body" class="form-control"></textarea>
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    @endif
                @endcan
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
                    @can("change",$maintenance)
                        @if($maintenance->state!="inactive")
                            <a href="{{route("maintenanceTransit",compact("maintenance"))}}"
                               class="list-group-item list-group-item-success">
                                @if($maintenance->state=="active")
                                    @lang("menu.close") @lang("maintenance.".$maintenance->type)
                                @else
                                    @lang("menu.start") @lang("maintenance.".$maintenance->type)
                                @endif</a>
                        @endif
                    @endcan
                    @foreach($maintenance->infected as $maintainable)
                        @component("info.Maintainable.item",compact("maintainable"))
                        @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </form>
@endsection
