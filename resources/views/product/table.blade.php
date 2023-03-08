<table class="table table-hover text-center">
    <thead>
        <tr class="bg-primary" style="color:white">
            <th scope="col">STT</th>
            <th scope="col">Mã sản phẩm</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Mã vạch</th>
            <th scope="col">Ghi chú</th>
            <th scope="col" colspan="2" style="width:10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $value)
        <tr>
            <th scope="row">{{ ++$key }}</th>
            <td>{{ $value->code }}</td>
            <td>{{ $value->name }}</td>
            <td>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($value->barcode != null ? $value->barcode : $value->code, 'C128',1,33,array(0,0,0), true) }}" alt="barcode" />
            </td>
            <td>{{ $value->note }}</td>
            <td class="action">
                <a class="btn btn-sm btn-warning" href="{{ route('product.edit', $value->id) }}">
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
<div class="paging" id="paginationProduct">
    {{ $products->render() }}
</div>
