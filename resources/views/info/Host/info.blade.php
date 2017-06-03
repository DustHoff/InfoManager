@component("info.Maintainable.info",["url"=>$url,"maintainable"=>isset($maintainable)?$maintainable:null,"type"=>$type,"selectHost"=> $selectHost])
    <div class="form-group">
        <div class="control-label col-sm-2">Stage</div>
        <div class="col-sm-10">
            <select id="stage" name="stage" class="form-control">
                @foreach(\App\Host::STAGE as $stage)
                    <option
                            @if(isset($maintainable))
                            @if($maintainable->maintainable->stage==$stage) selected
                            @endif value="{{$stage}}"
                            @endif>{{$stage}}</option>

                @endforeach
            </select>
            @if($errors->get("stage"))
                <div class="tooltip bottom" style="opacity: 1">
                    <div class="tooltip-arrow"></div>
                    <div class="tooltip-inner">
                        @foreach($errors->get("stage") as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">Owner</div>
        <div class="col-sm-10">
            <input name="owner" class="form-control col-sm-10"
                   value="{{$maintainable->maintainable->owner or ''}}">
        </div>
    </div>
@endcomponent