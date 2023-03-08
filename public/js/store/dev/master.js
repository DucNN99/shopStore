function message(data, form)
{
    var errors = data.responseJSON;
    if ($.isEmptyObject(errors) == false) {
        $(".remove-Invalid").removeClass("border-invalid");
        $(".remove-Invalid").removeClass("is-invalid");
        $.each(errors.errors, function (key, value) {
            notify("<div style='font-size:15px'><i class='fa fa-times'></i> " + value + "</div>",'error');
            if (form) {
                $(form+' #'+key).addClass("is-invalid");
                $(form+' #'+key).addClass('border-invalid');
                $(form+' #'+key).addClass('border-color-invalid');
            } else {
                $('#'+key).addClass("is-invalid");
                $('#'+key).addClass('border-invalid');
                $('#'+key).addClass('border-color-invalid');
            }
        });
    }
}

function number_decimal(money)
{
    if (money != '') {
        var natural     =   money.split(',')[0].replace( /\./g, '');
        var decimals    =   money.split(',')[1];
        return parseFloat(natural+'.'+decimals);
    } else {
        return 0;
    }
}

number_format = function(number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);

    var nstr = number.toString();
    nstr += '';
    x = nstr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

    return x1 + x2;
}
