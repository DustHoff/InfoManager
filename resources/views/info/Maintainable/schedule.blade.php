<div class="row">
    <div class="col-lg-9">
        <div class="list-group">
            <div class="list-group-item">
                <div class="list-group-item-heading">Schedule</div>
                <div class="list-group-item-text">
                    <form method="post" action="{{route("storeMaintenance")}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="maintenance_start"
                                       name="maintenance_start" placeholder="Start">
                                <script type="text/javascript">
                                    $("#maintenance_start").datetimepicker({
                                        format: "YYYY-MM-DD HH:mm:ss"
                                    });
                                </script>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" id="maintenance_end" name="maintenance_end" placeholder="End">
                                <script type="text/javascript">
                                    $("#maintenance_end").datetimepicker({
                                        format: "YYYY-MM-DD HH:mm:ss",
                                        useCurrent: false
                                    });
                                    $("#maintenance_start").on("dp.change", function (e) {
                                        $('#maintenance_end').data("DateTimePicker").minDate(e.date);
                                    });
                                </script>
                            </div>
                            <div class="col-lg-2">
                                <input type="checkbox" id="infect" name="infect" value="on" checked><label
                                        for="infect">Infect</label>
                            </div>
                            <div class="col-lg-2">
                                <select id="type" name="type" class="form-control">
                                    @foreach(\App\Maintenance::TYPE as $type)
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-2">
                                <input type="hidden" id="maintainable_id" name="maintainable_id"
                                       value="{{$maintainable->id}}">
                                <input type="submit" class="btn btn-success" value="Schedule">

                            </div>
                        </div>
                        <div class="row">
                                <textarea class="form-control" id="reason" name="reason"
                                          rows="10"></textarea>
                        </div>
                        @include("layout.error")
                    </form>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
            @foreach($maintainable->maintenances as $maintenance)
                @include("info.Maintenance.item")
            @endforeach
        </div>
    </div>
    <div class="col-lg-3">
        <div class="list-group">
            <div class="list-group-item">Infected Systems</div>
            @foreach($maintainable->infect() as $infectable)
                @component("info.Maintainable.item")
                @slot("url") {{route("maintainable",["maintainable"=>$infectable])}} @endslot
                {{$infectable->name}}
                @endcomponent
            @endforeach
        </div>
    </div>
</div>