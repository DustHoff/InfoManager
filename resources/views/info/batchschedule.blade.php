@extends("layout.master")
@section("content")
    @component("info.Maintenance.schedule")
    @slot("infected")
    <select class="form-control" name="maintainable[]" multiple>
        @foreach(\App\Maintainable::all() as $maintainable)
            <option value="{{$maintainable->id}}">{{$maintainable->name}}</option>
        @endforeach
    </select>
    @endslot
    @endcomponent
@endsection