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
                                <input type="submit" class="btn btn-success" value="@lang("menu.schedule")">

                            </div>
                        </div>
                        <div class="row">
                                <textarea class="form-control" id="reason" name="reason"
                                          rows="10"></textarea>
                        </div>
                        <div class="row">
                            <div id="cloud">

                            </div>
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
</form>
@if(isset($maintainable))
    <script>
        $("#type").change(function () {
            var type = this.value;
            $.get('{{route("getOption",["key"=>"","maintainable"=>""])}}/message_' + type + '/{{$maintainable->id or ''}}').done(function (data) {
                $("#reason").val(data);
            });
        });
        var type = $("#type").val();
        $.get('{{route("getOption",["key"=>"","maintainable"=>""])}}/message_' + type + '/{{$maintainable->id or ''}}').done(function (data) {
            $("#reason").val(data);
        });
    </script>
@endif
<script>
    $.ajaxSetup({
        contentType: "application/json; charset=utf-8"
    });
    function updateInfection() {
        $.post('{{route("apiMaintainables")}}',
            '{"maintainables" : [' + $("#maintainables").val() + "]," +
            '"infected" :' + $("#infect").is(":checked") + "}")
            .done(function (data) {
                $("#infected").empty();
                $.each(data, function (index, element) {
                    $.get('{{route("apiMaintainableHTML")}}/' + element.id).done(function (html) {
                        $("#infected").append(html);
                    })
                })
            })
            .fail(function () {
                alert("error");
            })
    }
    $("#infect").change(function () {
        updateInfection();
    })
    $("#maintainables").change(function () {
        updateInfection();
    })
</script>