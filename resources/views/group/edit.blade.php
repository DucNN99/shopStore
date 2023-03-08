@extends('layout.master')

@section('title') Cập nhập nhóm sản phẩm @endsection

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
                                    ['name' => 'Nhóm sản phẩm', 'url' => route('group-product.index')],
                                    ['name' => 'Cập nhập',  'url' => '']
                                ),
        ]
    )
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="formGroupProduct" class="outer-repeater needs-validation formGroupProduct" novalidate method="POST">
                        <input hidden value="update" name="option">
                        <input hidden value="{{ $group->id }}" name="update_id">
                        <div class="row no-gutters align-items-center">
                            <label class="col-form-label col-lg-3">Tên nhóm <span class="red"> *</span></label>
                            <div class="col-lg-8">
                                <input id="name" name="name" type="text" value="{{ $group->name }}" class="form-control form-control-sm" placeholder="Tên nhóm ..." required>
                                <div class="invalid-feedback"><em></em> Vui lòng nhập tên nhóm</div>
                            </div>

                            <label class="col-form-label col-lg-3 mt-2">Mô tả </label>
                            <div class="col-lg-8">
                                <textarea id="description" name="description" rows="5" class="form-control form-control-sm" placeholder="Mô tả ...">{{ $group->description }}</textarea>
                            </div>

                            <div class="col-lg-12 text-center mt-3">
                                <button class="btn btn-sm btn-success" type="submit">
                                    <i class="fas fa-plus"></i> Cập nhập
                                </button>
                                <a class="btn btn-sm btn-secondary" role="button" href="{{ route('group-product.index') }}">
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
    <script src="{{ asset('js/store/dev/group-product.js') }}"></script>
@endsection
