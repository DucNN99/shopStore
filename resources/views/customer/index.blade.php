@extends('layout.master')

@section('title') Khách hàng & NCC @endsection

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
                                    ['name' => 'Khách hàng & NCC', 'url' => route('customer.index')]
                                ),
            'button'    => array(
                                    ['name' => 'Thêm mới', 'icon' => 'fa-plus', 'class' => 'btn-primary', 'url' => route('customer.create')]
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
                                    <th scope="col">Mã KH/NCC</th>
                                    <th scope="col">Tên KH/NCC</th>
                                    <th scope="col">SĐT</th>
                                    <th scope="col">Phân loại</th>
                                    <th scope="col" colspan="2" style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $value)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $value->code }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->type == 0 ? 'Nhà cung cấp' : 'Khách hàng' }}</td>
                                    <td class="action">
                                        <a class="btn btn-sm btn-warning" href="{{ route('customer.edit', $value->id) }}">
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
                        <div class="paging" id="paginationCustomer">
                            {{ $customers->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/customer.js') }}"></script>
@endsection

