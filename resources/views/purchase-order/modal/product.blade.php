<div class="modal fade modal-product modal-select-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff;color:white">
                <h5 class="modal-title">Thêm mới sản phẩm</h5>
                <button type="button" class="close modal-select-close" data-dismiss="modal">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProduct" class="outer-repeater needs-validation formProduct" novalidate method="POST">
                    <input hidden value="create" name="option">
                    <div class="row no-gutters align-items-center">
                        <label class="col-form-label col-lg-3">Mã sản phẩm <span class="red"> *</span></label>
                        <div class="col-lg-8">
                            <input id="code" name="code" type="text" class="form-control form-control-sm" placeholder="Mã sản phẩm ..." required>
                            <div class="invalid-feedback"><em></em> Vui lòng nhập mã sản phẩm</div>
                        </div>

                        <label class="col-form-label col-lg-3">Tên sản phẩm <span class="red"> *</span></label>
                        <div class="col-lg-8">
                            <input id="name" name="name" type="text" class="form-control form-control-sm" placeholder="Tên sản phẩm ..." required>
                            <div class="invalid-feedback"><em></em> Vui lòng nhập tên sản phẩm</div>
                        </div>

                        <label class="col-form-label col-lg-3">Mã vạch</label>
                        <div class="col-lg-8">
                            <input id="barcode" name="barcode" type="text" class="form-control form-control-sm" placeholder="Mã vạch ...">
                        </div>

                        <label class="col-form-label col-lg-3 mt-2">Ghi chú </label>
                        <div class="col-lg-8">
                            <textarea id="note" name="note" rows="2"  class="form-control form-control-sm" placeholder="Mô tả ..."></textarea>
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

