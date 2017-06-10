<form method="post" action="{{route("storeMaintenance")}}">
    <div class="row">
        <div class="col-lg-9">
            <div class="list-group">
                <div class="list-group-item">
                    <div class="list-group-item-heading">@lang("menu.schedule")</div>
                    <div class="list-group-item-text">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-lg-3">
                                @component("html.error",["field"=>"maintenance_start"])
                                    <input type="text" class="form-control" id="maintenance_start"
                                           name="maintenance_start" placeholder="Start">
                                    <script type="text/javascript">
                                        $("#maintenance_start").datetimepicker({
                                            format: "YYYY-MM-DD HH:mm:ss"
                                        });
                                    </script>
                                @endcomponent
                            </div>
                            <div class="col-lg-3">
                                @component("html.error",["field"=>"maintenance_end"])
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
                                @endcomponent
                            </div>
                            <div class="col-lg-2">
                                <label><input type="checkbox" id="infect" class="checkbox" name="infect" value="on"
                                              checked>@lang("menu.infect")</label>
                            </div>
                            <div class="col-lg-2">
                                <select id="type" name="type" class="form-control">
                                    @foreach(\App\Maintenance::TYPE as $type)
                                        <option value="{{$type}}">{{__("maintenance.".$type)}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#finalSchedule">
                                    @lang("menu.schedule")
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            @component("html.error",["field"=>"reason"])
                                <textarea class="form-control" id="reason" name="reason"
                                          rows="10"></textarea>
                            @endcomponent
                        </div>
                        <div class="form-group">
                            <div id="targets" class="bootstrap-tagsinput"></div>
                        </div>
                        @include("layout.error")
                    </div>
                </div>
                @if(isset($maintainable))
                    @foreach($maintainable->maintenances->sortByDesc("maintenance_start") as $maintenance)
                        @component("info.Maintenance.item",compact("maintenance"))
                        @endcomponent
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            @if(isset($maintainable))
                <input type="hidden" id="maintainables" name="maintainable[]"
                       value="{{$maintainable->id}}">
                <input type="hidden" name="rootcause"
                       value="{{$maintainable->id}}">
            @else
                <select size="5" class="form-control list-group" id="maintainables" name="maintainable[]" multiple>
                    @foreach(\App\Maintainable::all() as $maintainable)
                        @can("schedule",$maintainable)
                            <option class="list-group-item" value="{{$maintainable->id}}">
                                {{$maintainable->name}}
                            </option>
                        @endcan
                    @endforeach
                    <?php unset($maintainable) ?>
                </select>
            @endif
            <div class="list-group">
                <div class="list-group-item">@lang("menu.infectedsystems")</div>
                <div id="infected">
                </div>
            </div>
        </div>
    </div>
    <div id="finalSchedule" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang("menu.schedule")</h4>
                </div>
                <div class="modal-body">
                    <p>@lang("menu.are_you_sure")</p>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="@lang("menu.schedule")">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<script>
    $.ajaxSetup({
        contentType: "application/json; charset=utf-8"
    });

    $("#type").change(function () {
        var type = this.value;

        if (type == '{{\App\Maintenance::TYPE[0]}}') {
            $("#maintenance_end").removeAttr('disabled');
        } else {
            $("#maintenance_end").attr("disabled", "disabled");
            $("#maintenance_start").val('{{\Carbon\Carbon::now()}}');

        }

        $.get('{{route("getOption",["key"=>""])}}/message_' + type).done(function (data) {
            $("#reason").val(data);
        });
    });
    $.get('{{route("getOption",["key"=>""])}}/message_' + $("#type").val()).done(function (data) {
        $("#reason").val(data);
    });

    function updateInfection() {
        $.post('{{route("apiMaintainables")}}',
            '{"maintainables" : [' + $("#maintainables").val() + "]," +
            '"infected" :' + $("#infect").is(":checked") + "}")
            .done(function (data) {
                $("#infected").empty();
                $("#targets").empty();
                $.each(data, function (index, element) {
                    $.get('{{route("apiMaintainableHTML")}}/' + element.id).done(function (html) {
                        $("#infected").append(html);
                        $.each(element.emails, function (mailindex, mailelement) {
                            if ($("#" + mailelement.id).length == 0)
                                $('#targets').append("<span id='" + mailelement.id + "' class='tag label label-info'>" + mailelement.email + "</span>");
                        })
                    })
                })
            })
    }
    $("#infect").change(function () {
        updateInfection();
    })
    $("#maintainables").change(function () {
        updateInfection();
    })
    updateInfection();
</script>
