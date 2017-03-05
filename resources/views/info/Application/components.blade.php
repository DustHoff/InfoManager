<div class="list-group">
    <div class="list-group-item">
        <form action="{{route("addDependency",$maintainable->maintainable->id)}}" method="post">
            {{csrf_field()}}
            <select name="dependency">
                @foreach(\App\Application::all() as $application)
                    <option value="{{$application->id}}">{{$application->maintainable->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success">add</button>
        </form>
    </div>
    @foreach($maintainable->maintainable->requires as $application)
        <div class="list-group-item">
            <a href="{{route("maintainable",$application->maintainable->id)}}">{{$application->maintainable->name}}</a>
            <a href="{{route("removeDependency",["application" => $maintainable->maintainable->id, "dependency" => $application->id])}}">
                <span class="glyphicon glyphicon-remove-sign"></span>
            </a>
        </div>
    @endforeach
</div>