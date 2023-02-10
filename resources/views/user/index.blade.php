@extends('layout.master')

@section('title') Tài khoản @endsection

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
                                    ['name' => 'Tài khoản', 'url' => route('user.index')]
                                ),
            'button'    => array(
                                    ['name' => 'Thêm mới', 'icon' => 'fa-plus', 'class' => 'btn-primary', 'url' => route('user.create')]
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Phân quyền</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $value)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        @if($value->role != 0)
                                            @if($value->status == 1)
                                                <h3 class="h6 mb-0 text-green-800">Hoạt động</h3>
                                            @else
                                                <h3 class="h6 mb-0 text-green-800">Khóa</h3>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $value->role == 0 ? 'Administration' : 'Người dùng' }}</td>
                                    <td class="action" colspan="{{ $value->role == 0 ? 2 : '' }}">
                                        <a class="btn btn-sm btn-warning" href="{{ route('user.edit', $value->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    @if($value->role != 0)
                                    <td class="action">
                                        <button data-id="{{ $value->id }}" class="btn btn-sm btn-danger action_delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paging" id="paginationUser">
                            {{ $users->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/user.js') }}"></script>
@endsection

