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
                            <option value="{{$application->maintainable->id}}">{{$application->name}}
                                ( @lang("maintainable.Host") {{$application->maintainable->host->maintainable->name}} )
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">@lang("menu.add",["thing"=>""])</button>
                </div>
            </form>
        </div>
    @endcan
    @foreach($maintainable->maintainable->requires as $application)
        <div class="list-group-item">
            <a href="{{route("maintainable",$application->maintainable->id)}}">{{$application->maintainable->name}}</a>
            <a href="{{route("removeDependency",["application" => $maintainable->maintainable->id, "dependency" => $application->id])}}">
                <span class="glyphicon glyphicon-remove-sign"></span>
            </a>
        </div>
    @endforeach
</div>