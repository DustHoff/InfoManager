@if(\Illuminate\Support\Facades\View::exists("info.".$type.".info"))
    @include("info.".$type.".info")
@else
    @include("info.Maintainable.info")
@endif
<script>
    $('#emails').tagsinput({
        typeahead: {
            source: function (query) {
                return $.get('{{route('emailAutocomplete')}}?email=' + query);
            }
        }
    })
    ;
    $('#emails').on('itemAdded', function (event) {
        setTimeout(function () {
            $('.bootstrap-tagsinput :input').val('');
        }, 0);
    });
</script>