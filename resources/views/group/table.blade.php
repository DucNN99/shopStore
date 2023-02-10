<table class="table table-hover text-center">
    <thead>
        <tr class="bg-primary" style="color:white">
            <th scope="col">STT</th>
            <th scope="col">Tên nhóm</th>
            <th scope="col">Mô tả</th>
            <th scope="col" colspan="2" style="width:10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $key => $value)
        <tr>
            <th scope="row">{{ ++$key }}</th>
            <td>{{ $value->name }}</td>
            <td>{{ $value->description }}</td>
            <td class="action">
                <a class="btn btn-sm btn-warning" href="{{ route('group-product.edit', $value->id) }}">
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
<div class="paging" id="paginationGroup">
    {{ $groups->render() }}
</div>
