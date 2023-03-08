
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('layout.style-link')
    @include('layout.script-link')
    @yield('css')
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
    <div id="wrapper">
        @include('layout.left-menu')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
    @include('user.change-password')
    @include('layout.component.modal')
    @yield('js')
</body>
</html>
