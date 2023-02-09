function message(data)
{
    var errors = data.responseJSON;
    if ($.isEmptyObject(errors) == false) {
        $(".remove-Invalid").removeClass("border-invalid");
        $(".remove-Invalid").removeClass("is-invalid");
        $.each(errors.errors, function (key, value) {
            notify("<div style='font-size:15px'><i class='fa fa-times'></i> " + value + "</div>",'error');
            $('#'+key).addClass("is-invalid");
            $('#'+key).addClass('border-invalid');
            $('#'+key).addClass('border-color-invalid');
        });
    }
}
