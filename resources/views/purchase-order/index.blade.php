@extends('layout.master')

@section('title') Đơn mua hàng @endsection

@section('css')
    <style>
        .action a{
            color:white !important;
        }
    </style>
@endsection

@section('content')
    @include('layout.action-tab',
        [
            'title'     => array(
                                    ['name' => 'Đơn mua hàng', 'url' => route('purchase-order.index')]
                                ),
            'button'    => array(
                                    ['name' => 'Thêm mới', 'icon' => 'fa-plus', 'class' => 'btn-primary', 'url' => route('purchase-order.create')]
                                ),
            'other'     => true
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center" id="data-table">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="bg-primary" style="color:white">
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Ngày mua</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col" colspan="2" style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $value)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td>{{ $value->order_code }}</td>
                                    <td>{{ optional($value->customer)->name }}</td>
                                    <td>{{ dateFormat($value->day_in) }}</td>
                                    <td>{{ number_format($value->total, 0, '.', ',') }}</td>
                                    <td>{{ $value->note }}</td>
                                    <td class="action">
                                        <a class="btn btn-sm btn-warning" href="{{ route('purchase-order.edit', $value->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="action">
                                        <button data-id="{{ $value->id }}" class="btn btn-sm btn-danger action_delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paging" id="paginationOrder">
                            {{ $orders->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/purchase-order.js') }}"></script>
@endsection

