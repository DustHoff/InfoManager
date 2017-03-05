@if(count($errors))
    <div class="form-group">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
