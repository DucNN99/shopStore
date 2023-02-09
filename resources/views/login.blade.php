<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/package/noty/noty.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js')}}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/package/noty/noty.min.js') }}"></script>
    <script src="{{ asset('/package/noty/noty.js') }}"></script>
    <style>
        .heading {
            font-weight: bold;
            text-align: center;
            font-size: 30px;
            color: #F96;
            padding-top: 10px;
        }
        .shadow {
            box-shadow:3px 3px 3px 3px #a4a4a4!important;
            border-radius:5px;
        }
    </style>
</head>
<body>
    @if (session('success'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('success') }} </div>",'success');
        </script>
    @elseif(session('danger'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-times'></i> {{ session('danger') }} </div>",'error');
        </script>
    @endif
    <div class="row mt-5" style="width:100%">
        <div class="col-lg-4 offset-lg-4 shadow">
            <header class="heading"> Đăng nhập</header><hr>
            <form action="{{ route('login') }}" novalidate class="login-form needs-validation" method="POST">
                @csrf
                <div class="row mt-5 mb-5">
                    <div class="col-lg-12 mt-3">
                        <div class="form-group">
                            <label class="col-lg-8 offset-lg-2">Tên đăng nhập :</label>
                            <div class="col-lg-8 offset-lg-2 mt-3">
                                <input type="text" name="username" placeholder="Tên đăng nhập" class="form-control" required>
                                <div class="invalid-feedback">Vui lòng nhập tên đăng nhập</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="form-group">
                            <label class="col-lg-8 offset-lg-2">Mật khẩu :</label>
                            <div class="col-lg-8 offset-lg-2 mt-3">
                                <input type="password" name="password" placeholder="Mật khẩu" class="form-control" required>
                                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5 mb-5">
                        <button class="btn btn-primary col-lg-8 offset-lg-2" type="submit">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('login-form');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</html>
