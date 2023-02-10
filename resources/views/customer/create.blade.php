@extends('layout.master')

@section('title') Thêm mới KH & NCC @endsection

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
                                    ['name' => 'Khách hàng & NCC', 'url' => route('customer.index')],
                                    ['name' => 'Thêm mới',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="formCustomer" class="outer-repeater needs-validation formCustomer" novalidate method="POST">
                        <input hidden value="create" name="option">
                        <div class="row no-gutters align-items-center">
                            <label class="col-form-label col-lg-3">Mã KH/NCC <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input id="code" name="code" type="text" class="form-control form-control-sm" value="{{ $code }}" placeholder="Mã KH/NCC ..." required readonly>
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
                                <button class="btn btn-sm btn-secondary" type="button" id="reset_btn">
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
    <script src="{{ asset('js/store/dev/customer.js') }}"></script>
@endsection
