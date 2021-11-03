<!DOCTYPE html>
<html class="dark-layout loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ setting('title') }} | @lang('words.login')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('favicon')) }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/pages/page-auth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/assets/css/style.css') }}">
    <link rel="stylesheet"type="text/css"  href="{{ asset('Panel/app-assets/vendors/css/extensions/toastr.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Panel/app-assets/css/plugins/extensions/ext-component-toastr.css') }}"/>
</head>
<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <a class="brand-logo" href="javascript:void(0);">
                            <h2 class="brand-text text-primary ml-1">{{ setting('title') }}</h2>
                        </a>
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset('Panel/app-assets/images/pages/cwapp.png') }}" alt="Login V2" /></div>
                        </div>
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">@lang('words.admin-panel')</h2>
                                <p class="card-text mb-2 text-success login-fw-bold">@lang('words.admin-login-alert')</p>
                                <form class="auth-login-form mt-2" action="index.html" method="POST">
                                    <div class="form-group">
                                        <label class="form-label" for="email">@lang('words.email')</label>
                                        <input class="form-control" type="text" id="email"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">@lang('words.password')</label>
                                        <input class="form-control" type="password" id="password"/>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="login">@lang('words.login')</button>
                                </form>
                                <div class="divider my-2">
                                    <div class="divider-text">↓</div>
                                </div>
                                <a href="{{ route('Web.main') }}" class="btn btn-primary btn-block">@lang('words.homepage')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Panel/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
    <script src="{{ asset('Panel/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).ready(function () {
            $("#login").on("click",function(e){
                e.preventDefault()
                var email = $("#email").val();
                var password = $("#password").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('Panel.login') }}",
                    data: {email:email, password:password},
                    dataType: 'json',
                    success: function (data) {
                        if(data.status == 200){
                            $("#email").attr("disabled", true);
                            $("#password").attr("disabled", true);
                            toastr.success('', data.message, { positionClass: "toast-bottom-left" })
                            setTimeout(function () {
                                window.location.href = '{{ route("Panel.main") }}'
                            }, 1500)
                        } else if(data.status == 201) {
                            toastr.error('', data.message, { positionClass: "toast-bottom-left" })
                        }
                    },
                    error: function (data) {
                        toastr.error('',  validateItem(data), { positionClass: "toast-bottom-left" })
                    },
                });
                
            });
        });
    </script>
    @if ($message = Session::get('success'))
        <script>
            toastr.success('', '{{ $message }}', { positionClass: "toast-bottom-left" })
        </script>
    @elseif ($message = Session::get('error'))
        <script>
            toastr.error('', '{{ $message }}', { positionClass: "toast-bottom-left" })
        </script>
    @endif
</body>
</html>