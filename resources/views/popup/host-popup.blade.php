<div id="add-host" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create new Host</h4>
            </div>
            <form id="host-data" class="form-group" method="post" action="{{route("storeHost")}}">
                <div class="modal-body">
                    <label for="name">Name</label><input id="name" name="name" type="text" class="form-control"><br>
                    <label for="owner">Owner</label><input id="owner" name="owner" type="text" class="form-control"><br>
                    <label for="zabbix">Zabbix ID</label><input id="zabbix" name="zabbix_id" type="text"
                                                                class="form-control"><br>
                    <label for="stage">Host</label>
                    <select id="stage" name="stage" class="form-control"><br>
                        @foreach(\App\Host::STAGE as $stage)
                            <option value="{{$stage}}">{{$stage}}</option>
                        @endforeach
                    </select><br>
                    <label for="on">Runs on</label>
                    <select id="on" name="host_id" class="form-control">
                        <option value="-1">No VM</option>
                        @foreach(\App\Host::query()->where("host_id","=","-1")->get() as $host)
                            <option value="{{$host->id}}">{{$host->maintainable->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="save" type="submit" class="btn btn-primary">Save</button>
                    @include("layout.error")
                </div>
            </form>
        </div>
    </div>
</div>