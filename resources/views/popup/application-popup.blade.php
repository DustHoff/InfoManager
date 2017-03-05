<div id="add-application" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create new Application</h4>
            </div>
            <form id="application-data" class="form-group" method="post" action="{{route("storeApplication")}}">
                <div class="modal-body">
                    <label for="name">Name</label><input id="name" name="name" type="text" class="form-control"><br>
                    <label for="host">Host</label>
                    <select id="host" name="host_id" class="form-control"><br>
                        @foreach(\App\Host::all() as $host)
                            <option value="{{$host->id}}">{{$host->maintainable->name}}</option>
                        @endforeach
                    </select><br>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="save" type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>