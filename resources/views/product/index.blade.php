@extends('layout.master')

@section('title') Sản phẩm @endsection

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
                                    ['name' => 'Sản phẩm', 'url' => route('product.index')]
                                ),
            'button'    => array(
                                    ['name' => 'Thêm mới', 'icon' => 'fa-plus', 'class' => 'btn-primary', 'url' => route('product.create')]
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/product.js') }}"></script>
@endsection

