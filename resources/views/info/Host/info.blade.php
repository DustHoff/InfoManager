@component("info.Maintainable.info",["url"=>$url,"maintainable"=>isset($maintainable)?$maintainable:null,"type"=>$type,"selectHost"=> $selectHost])
    <div class="form-group">
        <div class="control-label col-sm-2">Stage</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"stage"])
                <select id="stage" name="stage" class="form-control">
                    @foreach(\App\Host::STAGE as $stage)
                        <option
                                @if(isset($maintainable))
                                @if($maintainable->maintainable->stage==$stage) selected
                                @endif value="{{$stage}}"
                                @endif>{{$stage}}</option>

                    @endforeach
                </select>
            @endcomponent
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">Owner</div>
        <div class="col-sm-10">
            @component("html.error",["field"=>"owner"])
                <input id="owner" name="owner" class="form-control col-sm-10"
                       value="{{$maintainable->maintainable->owner or ''}}">
            @endcomponent
        </div>
    </div>
@endcomponent