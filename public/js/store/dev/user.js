$(document).ready(function(){
    $('#formUser').removeClass('was-validated');
    $('#formUser').trigger('reset');
});

var create_notify = new Noty({
    type:'warning',
    theme:'semanticui',
    modal:true,
    layout:'topCenter',
    text: '<p style="font-size:20px;"> Bạn có muốn thêm tài khoản nữa không ? </p>',
    buttons: [
        Noty.button('Có', 'btn btn-success', function () {
            $('#reset_btn').click();
            $('#formUser').removeClass('was-validated');
            $('#formUser').trigger('reset');
            create_notify.close();
        }),
        Noty.button('Không', 'btn btn-error', function () {
            window.location.href =  base_path+'/user';
            create_notify.close();
        })
    ]
});

(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('formUser');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                event.stopPropagation();

                if (form.checkValidity() === true) {
                    var option  = $('#formUser input[name=option]').val();
                    var data    = $('#formUser').serialize();
                    if (option == 'create') {
                        $.ajax({
                            type: 'POST',
                            url: base_path+'/user',
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
                        var id = $('#formUser input[name=update_id]').val();
                        $.ajax({
                            type: 'PUT',
                            url: base_path+'/user/'+id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: data,
                            success: function (data) {
                                notify("<div style='font-size:15px'><i class='fa fa-check'></i> Cập nhật thành công</div>",'success');
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

$(document).on('click', '#resetpassword',function(){
    var id              = $(this).data('id');
    var resetps_notify  = new Noty({
        type:'warning',
        theme:'semanticui',
        modal:true,
        layout:'topCenter',
        text: '<p style="font-size:20px;"> Bạn có muốn reset mật khẩu không ? </p>',
        buttons: [
            Noty.button('Có', 'btn btn-success', function () {
                $.ajax({
                    type: 'POST',
                    url: base_path+'/user/reset-password/'+id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        notify("<div style='font-size:15px'><i class='fa fa-check'></i> Reset mật khẩu thành công</div>",'success');
                        var new_pass  = new Noty({
                            type:'warning',
                            theme:'semanticui',
                            modal:true,
                            layout:'topCenter',
                            text: '<p style="font-size:20px;"> Mật khẩu mới : '+data+' </p>'
                        });
                        new_pass.show();
                    },
                    error: function (data) {
                        message(data);
                    }
                });
                resetps_notify.close();
            }),
            Noty.button('Không', 'btn btn-error', function () {
                resetps_notify.close();
            })
        ]
    });
    resetps_notify.show();

});

$(document).on('click','.action_delete',function(){
    var id  = $(this).data('id');
    var n   = new Noty({
        type:'warning',
        theme:'semanticui',
        modal:true,
        layout:'topCenter',
        text: '<p style="font-size:20px;"> Bạn có muốn xóa tài khoản này không ? </p>',
        buttons: [
        Noty.button('YES', 'btn btn-success', function () {
            $.ajax({
                type: 'DELETE',
                url: base_path+'/user/destroy/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    notify("<div style='font-size:15px'><i class='fa fa-check'></i> Xóa tài khoản thành công </div>",'success');
                    fetch_data($('#paginationUser .pagination .active .page-link').html());
                },
                error: function (data) {
                    message(data);
                }
            });
            n.close();
        }, {id: 'button1', 'data-status': 'ok'}),

        Noty.button('NO', 'btn btn-error', function () {
            n.close();
        })
        ]
    });
    n.show()
});

$('#search').on('keyup', function() {
    fetch_data();
});

$('#paginate').on('change', function() {
    fetch_data();
});

$(document).on('click', '#paginationUser .pagination a', function(e) {
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
        url: base_path+'/user/search',
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


