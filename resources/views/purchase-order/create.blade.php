@extends('layout.master')

@section('title') Thêm mới đơn mua hàng @endsection

@section('css')
    <style>
        .red{
            color:red;
        }
        label{
            font-weight:700;
            color:black;
        }
        table .select-box {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        table .form-control {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        table .select-box .form-control{
            margin-top: 0;
        }
    </style>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('layout.action-tab',
        [
            'title'     => array(
                                    ['name' => 'Đơn mua hàng', 'url' => route('purchase-order.index')],
                                    ['name' => 'Thêm mới',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="formOrder" class="outer-repeater needs-validation formOrder" novalidate method="POST">
                        <input hidden value="create" name="option">
                        <div class="row no-gutters align-items-center">
                            <label class="col-form-label col-lg-3">Mã đơn hàng <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input id="code" name="code" type="text" class="form-control form-control-sm" value="{{ $order_code }}" placeholder="Mã đơn hàng ..." required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập mã đơn hàng</div>
                            </div>

                            <label class="col-form-label col-lg-3">Khách hàng <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                @include('layout.component.input',[
                                    'type'    =>  'khachhang',
                                    'id'      =>  'customer_id',
                                    'name'    =>  'customer_id',
                                    'position'=>  'customer_id',
                                    'pass'    =>  'yes',
                                    'required'=>  'required',
                                ])
                                <div class="invalid-feedback"><em></em> Vui lòng chọn khách hàng</div>
                            </div>

                            <label class="col-form-label col-lg-3">Ngày mua <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input id="day_in" name="day_in" type="date" class="form-control form-control-sm" required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập ngày mua</div>
                            </div>
                            <hr>
                            <label class="col-form-label col-lg-12">Chi tiết đơn mua hàng </label>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-hover" id="table_data">
                                    <thead>
                                        <tr style="text-align:center;color:black">
                                            <th style="width:100px">
                                                @include('layout.component.add-row')
                                            </th>
                                            <th style="width:25%">Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                            <th>Ngày sản xuất</th>
                                            <th>Hạn sử dụng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-row">

                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="col-lg-6 row">
                                <label class="col-lg-2">Ghi chú </label>
                                <div class="col-lg-10">
                                    <textarea id="note" rows="3" name="note" class="form-control" placeholder="Ghi chú...">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label class="col-form-label col-lg-3 offset-lg-1">
                                        Tổng tiền
                                    </label>
                                    <div class="col-lg-8">
                                        <input id="total_all" name="total_all" type="text" class="form-control text-right" placeholder="Tổng tiền ..." readonly>
                                    </div>
                                </div>
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
    <table id="row_table" style="display: none">
        @include('purchase-order.row')
    </table>
    @include('purchase-order.modal.customer')
    @include('purchase-order.modal.product')
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/purchase-order.js') }}"></script>
@endsection
