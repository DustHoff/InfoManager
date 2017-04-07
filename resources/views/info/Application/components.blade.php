<div class="list-group">
    @can("edit",$maintainable)
        <div class="list-group-item">
            <form action="{{route("addDependency",$maintainable->maintainable->id)}}" method="post">
                {{csrf_field()}}
                <select name="dependency">
                    <option value="">@lang("menu.select",["thing"=>__("maintainable.Application")])</option>
                    @foreach(\App\Application::all() as $application)
                        @if($application->id == $maintainable->maintainable->id) @continue @endif
                        <option value="{{$application->id}}">{{$application->maintainable->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">@lang("menu.add",["thing"=>""])</button>
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