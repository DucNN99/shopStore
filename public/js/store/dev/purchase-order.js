$('.decimal').inputmask('decimal',{
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    'placeholder': '00',
});

var number = 0;

$('.add-item').click(function () {
    data = $('#row_table').html().replace("</tbody>","").replace("<tbody>","");

    number += 1;

    array_replace_old = ['A-'];
    array_replace_new = ['A-'+number];

    data = replaceRow(data,array_replace_old,array_replace_new);
    $('#show-row').append(data);
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
                    if (option == 'create') {
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
                    if (option == 'update') {
                        var id = $('#formOrder input[name=update_id]').val();
                        $.ajax({
                            type: 'PUT',
                            url: base_path+'/purchase-order/'+id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: data,
                            success: function (data) {
                                notify("<div style='font-size:15px'><i class='fa fa-check'></i> Cập nhập thành công</div>",'success');
                                setTimeout(function(){
                                    location.reload();
                                }, 1000);
                            },
                            error: function (data) {
                                message(data);
                            }
                        });
                    }

                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$('#search').on('keyup', function() {
    fetch_data();
});

$('#paginate').on('change', function() {
    fetch_data();
});

$(document).on('click', '#paginationOrder .pagination a', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
});

function fetch_data(page)
{
    var search      = $('#search').val();
    var perPage     = $('#paginate').val();
    $.ajax({
        type: "GET",
        url: base_path+'/purchase-order/search',
        data: {
            'search'    :search,
            'page'      :page,
            'perPage'   :perPage,
        },
        success: function(data) {
            $('#data-table').html(data);
        }
    });
}

$(document).on('click','.action_delete',function(){
    var id  = $(this).data('id');
    var n   = new Noty({
        type:'warning',
        theme:'semanticui',
        modal:true,
        layout:'topCenter',
        text: '<p style="font-size:20px;"> Bạn có muốn xóa sản phẩm này không ? </p>',
        buttons: [
        Noty.button('Có', 'btn btn-success', function () {
            $.ajax({
                type: 'DELETE',
                url: base_path+'/purchase-order/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    notify("<div style='font-size:15px'><i class='fa fa-check'></i> Xóa đơn mua hàng thành công </div>",'success');
                    fetch_data($('#paginationOrder .pagination .active .page-link').html());
                },
                error: function (data) {
                    message(data);
                }
            });
            n.close();
        }, {id: 'button1', 'data-status': 'ok'}),

        Noty.button('Không', 'btn btn-error', function () {
            n.close();
        })
        ]
    });
    n.show()
});
