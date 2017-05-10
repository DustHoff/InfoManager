<div id="add-application" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang("menu.create",["thing"=>__("maintainable.Application")])</h4>
            </div>
            <div class="modal-body">
                @component("info.Maintainable.info")
                    @slot("url") {{route("storeApplication")}} @endslot
                    @slot("name")@endslot
                    @slot("type") Application @endslot
                    @slot("host"){{$maintainable->maintainable->id or ''}}@endslot
                    @slot("monitoring")
                        @foreach(\App\Monitoring\Monitor::getList() as $monitoringitem)
                            <option value="{{$monitoringitem->identifier()}}" )>{{$monitoringitem->name()}}</option>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>