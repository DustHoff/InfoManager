@extends("layout.master")
@section("content")
    @component("info.Maintenance.schedule",["id"=>0])
        @slot("infected")
            <select class="form-control" name="maintainable[]" multiple>
                @foreach(\App\Maintainable::all() as $maintainable)
                    @can("schedule",$maintainable)
                        <option value="{{$maintainable->id}}">{{$maintainable->name}}</option>
                    @endcan
                @endforeach
            </select>
        @endslot
    @endcomponent
@endsection