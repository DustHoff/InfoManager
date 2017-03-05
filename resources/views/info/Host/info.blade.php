<form method="post" action="{{route("updateMaintainable",compact("maintainable"))}}">
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>{{csrf_field()}}<input name="name" value="{{$maintainable->name}}" class="form-control"></td>
        </tr>
        <tr>
            <td>Stage</td>
            <td>
                <select name="stage" class="form-control">
                    @foreach(\App\Host::STAGE as $stage)
                        <option @if($maintainable->maintainable->stage==$stage) selected
                                @endif value="{{$stage}}">{{$stage}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Owner</td>
            <td><input name="owner" class="form-control" value="{{$maintainable->maintainable->owner}}"></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>
                <input id="contacts" data-role="tagsinput" name="emails" value="@foreach($maintainable->emails()->get() as $email){{$email->email}},@endforeach" class="form-control">
            </td>
        </tr>
        <tr>
            <td>Applications</td>
            <td>{{$maintainable->maintainable->applications->count()}}</td>
        </tr>
        <tr>
            <td>Zabbix Host ID</td>
            <td><input name="zabbix_id" class="form-control" value="{{$maintainable->maintainable->zabbix_id}}"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="save" class="btn btn-success"></td>
        </tr>
    </table>
    @include("layout.error")
</form>