@if(\Illuminate\Support\Facades\View::exists("info.".$type.".info"))
    @include("info.".$type.".info")
@else
    @include("info.Maintainable.info")
@endif