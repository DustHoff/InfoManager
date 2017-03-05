@extends("layout.master")

@section("content")
    <table class="table">
        <thead>
        <tr>
            <td>#</td>
            <td style="width: 100%">Name</td>
            <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-application">create Application</button>
            </td>
            <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-host">create Host</button>
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($maintainables as $maintainable)
            <tr>
                <td>{{$maintainable->id}}</td>
                <td>{{$maintainable->name}}</td>
                <td><img src="/img/icon/{{$maintainable->maintainable_type}}.png"/></td>
                <td><a href="{{route("maintainable",$maintainable)}}"><span class="glyphicon glyphicon-zoom-in"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section("footer")
    @include("popup.application-popup")
    @include("popup.host-popup")
@endsection