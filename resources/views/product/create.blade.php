@extends('layout.master')

@section('title') Thêm mới sản phẩm @endsection

@section('css')
    <style>
        .red{
            color:red;
        }
        label{
            font-weight:700;
            color:black;
        }
    </style>
@endsection

@section('content')
    @include('layout.action-tab',
        [
            'title'     => array(
                                    ['name' => 'Sản phẩm', 'url' => route('product.index')],
                                    ['name' => 'Thêm mới',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
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
                                <button class="btn btn-sm btn-secondary" type="reset" id="reset_btn">
                                    <i class="fa fa-rotate-right"></i> Làm mới
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/product.js') }}"></script>
@endsection
