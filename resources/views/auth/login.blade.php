<!DOCTYPE html>
<html lang="ar">
<head>
    <title>Login</title>
    {!! Html::style('public/assets/css/font-awesome.min.css') !!}
    {!! Html::style('public/assets/' . getPageDirection() . '/dist/css/adminlte.min.css') !!}
    {!! Html::style('public/assets/css/style.css') !!}
</head>
<body class="hold-transition login-page" dir="rtl">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                {{trans('login.title')}}
            </div>
            <form id="loginForm" method="POST" role="form"  
            action="{{ route('login.perform') }}" class="form-horizontal">
                <div class="card-body">
                    @if(Session::has("user-error"))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get("user-error") }}
                    </div>
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label text-md-left required">{{trans('login.phon_no')}}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control border-gray font-body-md @error('mobile') is-invalid @enderror round numeric" id="mobile" value="{{ old('mobile') }}" name="mobile" required autofocus>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-left required">{{trans('login.password')}}</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control border-gray @error('password') is-invalid @enderror round" id="password" name="password" autocomplete="off" placeholder="******" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-block btn-info">
                            {{trans('login.login')}}
                        </button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</body>
</html>
