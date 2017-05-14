<form method="post" action="#">
    {!! $options = \App\Option::paginate(10) !!}
    {{$options->links()}}
    @foreach($options as $option)
        <div class="form-group">
            <div class="control-label col-sm-4">@lang("option.".$option->name)</div>
            <div class="col-sm-8">
                <textarea name="option[{{$option->name}}]" class="form-control" rows="10">
                    {{$option->value}}
                </textarea>
            </div>
        </div>
    @endforeach
    <div class=""></div>
    {{$options->links()}}
</form>