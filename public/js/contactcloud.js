$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#contacts').tagsinput({
    confirmKeys: [9],
    trimValue: true,
    allowDuplicates: false
});