@extends('layout.master')

@section('title') Cập nhật tài khoản @endsection

@section('css')
    <style>
        .red{
            color:red;
        }
        label{
            font-weight:700;
            color:black;
        }
        .noty_buttons{
            text-align:center;
        }
    </style>
@endsection

@section('content')
    @include('layout.action-tab',
        [
            'title'     => array(
                                    ['name' => 'Tài khoản', 'url' => route('user.index')],
                                    ['name' => 'Cập nhật',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="formUser" class="outer-repeater needs-validation formUser" novalidate method="POST">
                        <input hidden value="update" name="option">
                        <input hidden value="{{ $user->id }}" name="update_id">
                        <div class="row no-gutters align-items-center">
                            <label class="col-form-label col-lg-3">Tên đăng nhập <span class="red"> *</span>:</label>
                            <div class="col-lg-8">
                                <input id="username" name="username" value="{{ $user->username }}" type="text" class="form-control form-control-sm" placeholder="Tên đăng nhập ..." required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập tên đăng nhập</div>
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Email :</label>
                            <div class="col-lg-8">
                                <input id="email" name="email" type="text" value="{{ $user->email }}" class="form-control form-control-sm" placeholder="Email ...">
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Trạng thái :</label>
                            <div class="col-lg-8">
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1" {{ $user->status == 1 ? 'selected' : ''}}>Hoạt động</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : ''}}>Khóa</option>
                                </select>
                            </div>

                            <div class="col-lg-12 text-center mt-3">
                                <button class="btn btn-sm btn-success" type="submit">
                                    <i class="fas fa-plus"></i> Cập nhật
                                </button>
                                <button class="btn btn-sm btn-warning" type="button" id="resetpassword" data-id="{{ $user->id }}">
                                    <i class="fas fa-key"></i> Reset mật khẩu
                                </button>
                                <a class="btn btn-sm btn-secondary" role="button" href="{{ route('user.index') }}">
                                    <i class="fa fa-rotate-right"></i> Trở lại
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/store/dev/user.js') }}"></script>
@endsection
