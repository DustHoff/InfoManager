<form method="post" action="{{route("storeMaintenance")}}">
    <div class="row">
        <div class="col-lg-9">
            <div class="list-group">
                <div class="list-group-item">
                    <div class="list-group-item-heading">@lang("menu.schedule")</div>
                    <div class="list-group-item-text">
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
                                <input type="text" class="form-control" id="maintenance_end" name="maintenance_end"
                                       placeholder="End">
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
                                <label><input type="checkbox" id="infect" class="checkbox" name="infect" value="on" checked>Infect</label>
                            </div>
                            <div class="col-lg-3">
                                <select id="type" name="type" class="form-control">
                                    @foreach(\App\Maintenance::TYPE as $type)
                                        <option value="{{$type}}">{{__("maintenance.".$type)}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-success" value="Schedule">

                            </div>
                        </div>
                        <div class="row">
                                <textarea class="form-control" id="reason" name="reason"
                                          rows="10"></textarea>
                        </div>
                        @include("layout.error")
                    </div>
                </div>
                {{$slot or ''}}
            </div>
        </div>
        <div class="col-lg-3">
            {{$infected or ''}}
        </div>
    </div>
</form>