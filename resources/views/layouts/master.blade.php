<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
$pageDir = getPageDirection();
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {!! Html::style('public/assets/css/main.css') !!}
    @yield('styles')
    {!! Html::style('public/assets/plugins/fontawesome/css/all.min.css') !!}
    {!! Html::style('public/assets/css/font-awesome.min.css') !!}
    @yield('extra_styles')

    {!! Html::style('public/assets/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    {!! Html::style('public/assets/' . $pageDir . '/dist/css/adminlte.min.css') !!}
    {!! Html::style('public/assets/css/style.css') !!}
    {!! Html::script('public/assets/plugins/jquery/jquery.min.js') !!}
    @yield('styles-after')
    {!! Html::style('public/assets/plugins/sweetalert2/sweetalert2.min.css') !!}
    {!! Html::style('public/assets/css/pagination.css') !!}
    {!! Html::style('public/assets/plugins/toastr/toastr.min.css') !!}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>

<body class="hold-transition layout-fixed  sidebar-mini {{ $pageDir }}" dir="{{ $pageDir }}">
    @stack('body_start')
    <div class="wrapper">

        @include('includes.navbar')
        @include('includes.sidebar')
        <main class="content-wrapper">
            <section class="content-header p-1 mb-2">
                <div class="breadcrumbs p-2">
                    @yield('breadcrumbs')
                </div>
            </section>
            <div class="pt-1 pb-1 pl-3 pr-3">
                <div class="card" style="min-height: calc(100vh - (12.5rem + 1px));">
                    <div class="card-header">
                        @yield('pageHeader')
                    </div>
                    <div class="card-body p-1">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                    @yield('tablePagination')
                </div>
            </div>
        </main>
        <footer class="main-footer text-center"> {{ trans('m.siteFooter') }} &copy; </footer>
    </div>
    @stack('body_end')
    {!! Html::script('public/assets/' . $pageDir . '/dist/js/adminlte.min.js') !!}
    {!! Html::script('public/assets/' . $pageDir . '/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
    {!! Html::script('public/assets/js/FileUploader.js') !!}
      @yield('extra_scripts')

    {!! Html::script('public/assets/plugins/popper.js/popper.min.js') !!}
    {!! Html::script('public/assets/plugins/select2/js/select2.full.min.js') !!}
    {!! Html::script('public/assets/js/sweetalert2.min.js') !!}
    {!! Html::script('public/assets/plugins/toastr/toastr.min.js') !!}
    {!! Html::script('public/assets/js/main_shared_script.js') !!}

    @include('includes.scripts')
    @yield('validation_scripts')
    @yield('scripts')

    @yield('form_scripts')
</body>

</html>
