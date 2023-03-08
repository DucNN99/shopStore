$('.add-item').click(function () {
    data = $('#row_table').html().replace("</tbody>","").replace("<tbody>","");

    $('#show-row').append(data);
    $('#show-row .product').select2();
    $('#show-row .decimal').inputmask('decimal',{
        'alias': 'numeric',
        'groupSeparator': '.',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        'placeholder': '00',
    });
});

function calculator(e)
{
    var soluong             =   number_decimal(e.parent().parent().find('.quantity').val());
    var dongia              =   number_decimal(e.parent().parent().find('.cost').val());
    var tienhang            =   soluong * dongia;
    e.parents('tr').find('.total').val(number_format(tienhang, 2, ',', '.'));
    total();
}

function total()
{
    var tongtien = 0;
    $('#show-row .total').each(function () {
        tongtien += number_decimal($(this).val());
    });
    $('#total_all').val(number_format(tongtien, 2, ',', '.'));
}

$(document).on('keyup','.quantity',function(){
    calculator($(this));
});

$(document).on('keyup','.cost',function(){
    calculator($(this));
});

$('#reset_btn').on('click', function(){
    $('#formOrder').removeClass('was-validated');
    $('#formOrder').trigger('reset');
    $('#show-row').html('');
    $('#customer').select2('');
});

$('#add-customer').on('click', function(){
    $('#formCustomer').removeClass('was-validated');
    $('#formCustomer').trigger('reset');
    $.ajax({
        type: "GET",
        url: base_path+'/customer/code',
        success: function(data) {
            $('#formCustomer').removeClass('was-validated');
            $('#formCustomer').trigger('reset');
            $('#formCustomer #code').val(data);
        }
    });
});

var create_notify = new Noty({
    type:'warning',
    theme:'semanticui',
    modal:true,
    layout:'topCenter',
    text: '<p style="font-size:20px;"> Bạn có muốn thêm đơn mua hàng nữa không ? </p>',
    buttons: [
        Noty.button('Có', 'btn btn-success', function () {
            $('#formOrder').removeClass('was-validated');
            $('#formOrder').trigger('reset');
            $('#show-row').html('');
            $('#customer').select2('');
            create_notify.close();
        }),
        Noty.button('Không', 'btn btn-error', function () {
            window.location.href =  base_path+'/purchase-order';
            create_notify.close();
        })
    ]
});

(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('formOrder');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();

                if (form.checkValidity() === true) {
                    var option  = $('#formOrder input[name=option]').val();
                    var data    = $('#formOrder').serialize();
                    $.ajax({
                        type: 'POST',
                        url: base_path+'/purchase-order',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        success: function (data) {
                            notify("<div style='font-size:15px'><i class='fa fa-check'></i> Thêm mới thành công</div>",'success');
                            create_notify.show();
                        },
                        error: function (data) {
                            message(data);
                        }
                    });
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
