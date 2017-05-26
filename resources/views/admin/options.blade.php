{!! $options = \App\Option::paginate(10) !!}
{{$options->links()}}
<form method="post" action="{{ route("updateOptions") }}">
    @foreach($options as $option)
        <div class="form-group">
            <div class="control-label col-sm-4">@lang("option.".$option->name)</div>
            <div class="col-sm-8">
                <textarea name="option[{{$option->name}}]" class="form-control" rows="10">{{$option->value}}</textarea>
            </div>
        </div>
    @endforeach
    <div class="col-sm-offset-4 col-sm-8">
        {{ csrf_field() }}
        <input type="submit" value="@lang("menu.save")" class="btn btn-success">
    </div>
</form>
{{$options->links()}}