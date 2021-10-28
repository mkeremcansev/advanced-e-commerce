@extends('Panel.main')
@section('title')
@lang('words.theme-settings')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#update").on("click",function(e){
        var primary = $('#primary').val()
        var secondary = $('#secondary').val()
        $.ajax({
            type: 'POST',
            url: "{{ route('Panel.Theme.update') }}",
            data: {primary:primary, secondary:secondary},
            dataType: 'json',
            success: function (data) {
                toastr.success('', data.success, { positionClass: "toast-bottom-right" })
            },
            error: function (data) {
                toastr.error('',  validateItem(data), { positionClass: "toast-bottom-right" })
            },
        });
        
    });
    $('#primary, #secondary').spectrum({
        type: "component"
    });
});
</script>
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body">
                                @lang('words.service-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.theme-settings')</h4>
                            </div>
                            <form id="service_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="color">@lang('words.primary-color')</label>
                                       <input id="primary" class="form-control" value="{{ $themes->primary }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">@lang('words.secondary-color')</label>
                                       <input id="secondary" class="form-control" value="{{ $themes->secondary }}"/>
                                    </div>
                                    <button type="button" id="update" class="btn btn-primary waves-effect waves-float waves-light mt-2 mb-2 float-right">@lang('words.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection