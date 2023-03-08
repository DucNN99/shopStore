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
