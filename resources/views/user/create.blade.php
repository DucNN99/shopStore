@extends('layout.master')

@section('title') Thêm mới tài khoản @endsection

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
                                    ['name' => 'Tài khoản', 'url' => route('user.index')],
                                    ['name' => 'Thêm mới',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="formUser" class="outer-repeater needs-validation formUser" novalidate method="POST">
                        <input hidden value="create" name="option">
                        <div class="row no-gutters align-items-center">
                            <label class="col-form-label col-lg-3">Tên đăng nhập <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input id="username" name="username" type="text" class="form-control form-control-sm required" placeholder="Tên đăng nhập ..." required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập tên đăng nhập</div>
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Email </label>
                            <div class="col-lg-8">
                                <input id="email" name="email" type="text" class="form-control form-control-sm required" placeholder="Email ...">
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Mật khẩu <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input name="password" type="password" id="password" class="form-control form-control-sm" placeholder="Mật khẩu..." required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập mật khẩu</div>
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Trạng thái </label>
                            <div class="col-lg-8">
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1" selected>Hoạt động</option>
                                    <option value="0">Khóa</option>
                                </select>
                            </div>

                            <div class="col-lg-12 text-center mt-3">
                                <button class="btn btn-sm btn-success" type="submit">
                                    <i class="fas fa-plus"></i> Thêm
                                </button>
                                <button class="btn btn-sm btn-secondary" type="reset" id="reset_btn">
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
    <script src="{{ asset('js/store/dev/user.js') }}"></script>
@endsection
