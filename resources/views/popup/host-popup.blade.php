<div id="add-host" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang("menu.create",["thing"=>__("maintainable.Host")])</h4>
            </div>
            <div class="modal-body">
                @component("info.Maintainable.info")
                @slot("url") {{route("storeHost")}} @endslot
                @slot("name")@endslot
                @slot("type") Host @endslot
                @slot("host"){{$maintainable->maintainable->id or ''}}@endslot
                    @slot("monitoring")
                        @foreach(\App\Monitoring\Monitor::getList() as $monitoringitem)
                            <option value="{{$monitoringitem->identifier()}}" )>{{$monitoringitem->name()}}</option>
                        @endforeach
                    @endslot
                    <div class="form-group">
                    <div class="control-label col-sm-2">Stage</div>
                    <div class="col-sm-10">
                        <select id="stage" name="stage" class="form-control">
                            @foreach(\App\Host::STAGE as $stage)
                                <option value="{{$stage}}">{{$stage}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="control-label col-sm-2">Owner</div>
                    <div class="col-sm-10">
                        <input name="owner" class="form-control col-sm-10"
                               value="">
                    </div>
                </div>
                @endcomponent
            </div>
        </div>
    </div>
</div>