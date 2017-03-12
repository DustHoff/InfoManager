<div id="add-application" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create new Application</h4>
            </div>
            <div class="modal-body">
                @component("info.Maintainable.info")
                @slot("url") {{route("storeApplication")}} @endslot
                @slot("name")@endslot
                @slot("type") Application @endslot
                @slot("host")@endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>