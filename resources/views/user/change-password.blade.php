<div class="modal fade changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-password needs-validation" novalidate id="form-password">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Thay đổi mật khẩu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body div-shadow-none">
                    <div class="row" style="margin-bottom:15px">
                        <div class="col-lg-4">
                            <label>Nhập lại mật khẩu</label><span class="red"> *</span> :
                        </div>
                        <div class="col-lg-8">
                            <input type="password" id="passwordchange" name="passwordchange" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">Mật khẩu cũ không để trống</div>
                        </div>
                    </div>
                    <div class="row mt-3" style="margin-bottom:15px">
                        <div class="col-lg-4">
                            <label>Nhập mật khẩu mới</label><span class="red"> *</span> :
                        </div>
                        <div class="col-lg-8">
                            <input type="password" name="new_passwordchange" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">Mật khẩu mới không để trống</div>
                        </div>
                    </div>
                    <div class="row mt-3" style="margin-bottom:15px">
                        <div class="col-lg-4">
                            <label>Nhập lại mật khẩu mới</label><span class="red"> *</span> :
                        </div>
                        <div class="col-lg-8">
                            <input type="password" name="confirm_passwordchange" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">Phải nhập lại mật khẩu mới</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12 text-center">
                        <button type="submit" id="update_password" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Cập nhập</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('form-password');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        event.stopPropagation();
                    if (form.checkValidity() === true) {
                        var data = $('#form-password').serialize();
                        password_update(data);
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function password_update(data)
    {
        $.ajax({
            type: "POST",
            url: base_path+'/change-password',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data,
            success: function (data) {
                if (data.success == true) {
                    notify("<div style='font-size:15px;color:white'><i class='fa fa-check'></i> "+data.msg+"</div>",'success');
                    $('.changepassword').modal('hide');
                } else {
                    notify("<div style='font-size:15px;color:white'><i class='fa fa-times'></i> "+data.msg+"</div>",'error');
                }
            },
            error: function (data) {
                message(data);
            }
        });
    }
</script>
