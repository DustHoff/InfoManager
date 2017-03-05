<form method="post" action="{{route("updateMaintainable",compact("maintainable"))}}">
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>{{csrf_field()}}<input name="name" value="{{$maintainable->name}}" class="form-control"></td>
        </tr>
        <tr>
            <td>Host</td>
            <td><a href="{{route("maintainable",["maintainable"=>$maintainable->maintainable->host])}}">{{$maintainable->maintainable->host->maintainable->name}}</a></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>
                <input id="contacts" data-role="tagsinput" name="emails" value="@foreach($maintainable->emails()->get() as $email){{$email->email}},@endforeach" class="form-control">
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="save" class="btn btn-success"></td>
        </tr>
    </table>
    @include("layout.error")
</form>