{{$slot or ''}}
@if($errors->has($field))
    <span id="help-{{$field}}" class="help-block">
        @foreach($errors->get($field) as $message)
            {{$message}}
        @endforeach
    </span>
@endif