<div class="list-group">
    @can("edit",$maintainable)
        <div class="list-group-item">
            <form action="{{route("addDependency",$maintainable->maintainable->id)}}" method="post" class="form-inline">
                {{csrf_field()}}
                <div class="form-group">
                    <select name="dependency" class="form-control">
                        <option value="">@lang("menu.select",["thing"=>__("maintainable.Application")])</option>
                        @foreach(\App\Maintainable::query()->where("maintainable_type","=","Application")->orderBy("name")->get() as $application)
                            @if($application->id == $maintainable->id) @continue @endif
                            @can("view",$application)
                                <option value="{{$application->maintainable->id}}">{{$application->name}}
                                    ( @lang("maintainable.Host") {{$application->maintainable->host->maintainable->name}}
                                    )
                                </option>
                            @endcan
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">@lang("menu.add",["thing"=>""])</button>
                </div>
            </form>
        </div>
    @endcan
    @foreach($maintainable->maintainable->requires as $application)
        @component("info.Maintainable.item",["maintainable"=>$application->maintainable])}}")
        @endcomponent
    @endforeach
</div>