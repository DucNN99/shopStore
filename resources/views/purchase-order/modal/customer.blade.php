<div class="modal fade modal-customer modal-select-customer" id="modal-select-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff;color:white">
                <h5 class="modal-title">Thêm mới khách hàng</h5>
                <button type="button" class="close modal-select-close" data-dismiss="modal">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCustomer" class="outer-repeater needs-validation formCustomer" novalidate method="POST">
                    <input hidden value="create" name="option">
                    <div class="row no-gutters align-items-center">
                        <label class="col-form-label col-lg-3">Mã KH/NCC <span class="red"> *</span></label>
                        <div class="col-lg-8">
                            <input id="code" name="code" type="text" class="form-control form-control-sm" placeholder="Mã KH/NCC ..." required>
                            <div class="invalid-feedback"><em></em> Vui lòng nhập mã KH/NCC</div>
                        </div>

                        <label class="col-form-label col-lg-3">Tên KH/NCC <span class="red"> *</span></label>
                        <div class="col-lg-8">
                            <input id="name" name="name" type="text" class="form-control form-control-sm" placeholder="Tên KH/NCC ..." required>
                            <div class="invalid-feedback"><em></em> Vui lòng nhập KH/NCC</div>
                        </div>

                        <label class="col-form-label col-lg-3">Phân loại</label>
                        <div class="col-lg-8">
                            <select class="form-control form-control-sm" name="type" id="type">
                                <option value="0">Nhà cung cấp</option>
                                <option value="1" selected>Khách hàng</option>
                            </select>
                        </div>

                        <label class="col-form-label col-lg-3">Số điện thoại</label>
                        <div class="col-lg-8">
                            <input id="phone" name="phone" type="text" class="form-control form-control-sm" placeholder="Số điện thoại ...">
                        </div>

                        <label class="col-form-label col-lg-3">Địa chỉ</label>
                        <div class="col-lg-8">
                            <input id="address" name="address" type="text" class="form-control form-control-sm" placeholder="Địa chỉ ...">
                        </div>

                        <label class="col-form-label col-lg-3">Email</label>
                        <div class="col-lg-8">
                            <input id="email" name="email" type="text" class="form-control form-control-sm" placeholder="Email ...">
                        </div>

                        <label class="col-form-label col-lg-3 mt-2">Mô tả </label>
                        <div class="col-lg-8">
                            <textarea id="description" name="description" rows="5"  class="form-control form-control-sm" placeholder="Mô tả ..."></textarea>
                        </div>

                        <div class="col-lg-12 text-center mt-3">
                            <button class="btn btn-sm btn-success" type="submit">
                                <i class="fas fa-plus"></i> Thêm
                            </button>
                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">
                                <i class="fas fa-times"></i> Đóng
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

