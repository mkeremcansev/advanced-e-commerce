@extends('Back.main')
@section('title')
@lang('words.service-add')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#add").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("name", $("#name").val());
        formData.append("color", $("#color").val());
        formData.append("image", $("#image").prop("files")[0]);
        formData.append("add", "add");
        $.ajax({
            type: 'POST',
            url: "{{ route('Service.add') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#service_form")[0].reset();
                toastr.success('', data.success, { positionClass: "toast-bottom-right" })
            },
            error: function (data) {
                toastr.error('',  validateItem(data), { positionClass: "toast-bottom-right" })
            },
        });
        
    });
    $('#color').spectrum({
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
                                <h4 class="card-title">@lang('words.service-add')</h4>
                            </div>
                            <form id="service_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('words.service-name')</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="color">@lang('words.service-color')</label>
                                       <input id="color" class="form-control" value="#ffffff"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">@lang('words.service-image')</label>
                                        <input type="file" class="form-control" id="image">
                                    </div>

                                <button type="button" id="add" class="btn btn-primary waves-effect waves-float waves-light mt-2 mb-2 float-right">@lang('words.save')</button>
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