@extends('Web.main')
@section('title')
{{ $settings->title }} - @lang('words.login') - @lang('words.register')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#register").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("name", $("#name").val());
        formData.append("phone", $("#phone").val());
        formData.append("email", $("#email").val());
        formData.append("password", $("#password").val());
        formData.append("repeat", $("#repeat").val());
        if($('#policy').is(':checked')){
            formData.append("policy", 1);
        } else if($('#policy').is(':not(:checked)')) {
            formData.append("policy", "");
        }
        formData.append("register", "register");
        $.ajax({
            type: 'POST',
            url: "{{ route('Web.Register.add') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#register_form")[0].reset();
                $("#register").attr("disabled", true);
                iziToast.success({
                    message: data.success
                });
            },
            error: function (data) {
                iziToast.error({
                    message: validateItem(data)
                });
            },
        });
        
    });

    $("#login").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("login_email", $("#login_email").val());
        formData.append("login_password", $("#login_password").val());
        formData.append("login", "login");
        $.ajax({
            type: 'POST',
            url: "{{ route('Web.Login.add') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data.status == 200){
                    $("#login").attr("disabled", true);
                    $("#login_email").attr("disabled", true);
                    $("#login_password").attr("disabled", true);
                    iziToast.success({
                        message: data.message
                    });
                    setTimeout(function () {
                        window.location.href = '{{ route("Web.account") }}'
                    }, 1500)
                    
                } else if(data.status == 201) {
                    iziToast.error({
                        message: data.message
                    });
                }
            },
            error: function (data) {
                iziToast.error({
                    message: validateItem(data)
                });
            },
        });
        
    });
});
</script>
@endsection
@section('content')
<main class="main">
<div class="page-header breadcrumb-wrap">
    <div class="container canseworksBlack">
        <span></span><a href="{{route('Web.main')}}">Ana Sayfa</a> >
        <span></span>@lang('words.login') - @lang('words.register')
    </div>
</div>
<section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">@lang('words.login')</h3>
                                        </div>
                                        <form id="login_form">
                                            <div class="form-group">
                                                <input type="email" required="" id="login_email" placeholder="@lang('words.email')">
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" id="login_password" placeholder="@lang('words.password')">
                                            </div>
                                            <div class="login_footer form-group">
                                                <a class="text-muted" href="#">Şifremi unuttum</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="login" class="btn btn-fill-out btn-block hover-up">@lang('words.login')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">@lang('words.register')</h3>
                                        </div>
                                        <p class="mb-50 font-sm">@lang('words.register-alert')</p>
                                       
                                        <form id="register_form">
                                             <div class="row">
                                            <div class="form-group ">
                                                <input type="text" required="" id="name" placeholder="@lang('words.name-surname')">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <input type="text" required="" id="phone" placeholder="@lang('words.phone')">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <input type="email" required="" id="email" placeholder="@lang('words.email')">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <input required="" type="password" id="password" placeholder="@lang('words.password')">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <input required="" type="password" id="repeat" placeholder="@lang('words.password-repeat')">
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" id="policy">
                                                        <label class="form-check-label" for="policy"><a href="{{ route('Web.main') }}"><span>@lang('words.register-policy')</span></a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="register" class="btn btn-fill-out btn-block hover-up">@lang('words.register')</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
@endsection