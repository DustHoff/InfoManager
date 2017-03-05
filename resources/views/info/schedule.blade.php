<div class="list-group">
    <div class="list-group-item">
        <div class="list-group-item-heading">Schedule</div>
        <div class="list-group-item-text">
            <form method="post" action="{{route("storeMaintenance")}}">
                {{ csrf_field() }}
                <table class="table form-group">
                    <tr>
                        <td>Start</td>
                        <td>
                            <input type="text" class="form-control" id="maintenance_start"
                                   name="maintenance_start">
                            <script type="text/javascript">
                                $("#maintenance_start").datetimepicker({
                                    format: "YYYY-MM-DD HH:mm"
                                });
                            </script>
                        </td>
                        <td>End</td>
                        <td>
                            <input type="text" class="form-control" id="maintenance_end" name="maintenance_end">
                            <script type="text/javascript">
                                $("#maintenance_end").datetimepicker({
                                    format: "YYYY-MM-DD HH:mm",
                                    useCurrent: false
                                });
                                $("#maintenance_start").on("dp.change", function (e) {
                                    $('#maintenance_end').data("DateTimePicker").minDate(e.date);
                                });
                            </script>
                        </td>
                        <td><select id="type" name="type" class="form-control">
                                @foreach(\App\Maintenance::TYPE as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select></td>
                        <td><input type="hidden" id="maintainable_id" name="maintainable_id"
                                   value="{{$maintainable->id}}">
                            <input type="submit" class="btn btn-success" value="Schedule"></td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea class="form-control" id="reason" name="reason"
                                                  rows="10"></textarea></td>
                    </tr>
                </table>
                @include("layout.error")
            </form>
        </div>
    </div>
    @foreach($maintainable->maintenances as $maintenance)
        @include("info.maintenance.item")
    @endforeach
</div>