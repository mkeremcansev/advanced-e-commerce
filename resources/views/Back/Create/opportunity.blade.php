@extends('Back.main')
@section('title')
@lang('words.opportunity-add')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#add").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("title", $("#title").val());
        formData.append("product_id", $("#product_id").val());
        formData.append("end", $("#end").val());
        formData.append("image", $("#image").prop("files")[0]);
        formData.append("add", "add");
        $.ajax({
            type: 'POST',
            url: "{{ route('Opportunity.add') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#add").attr("disabled", true)
                toastr.success('', data.success, { positionClass: "toast-bottom-right" })
                $("#opportunity_form")[0].reset();
                setTimeout(function () {
                    location.reload();
                }, 1000)
            },
            error: function (data) {
                toastr.error('',  validateItem(data), { positionClass: "toast-bottom-right" })
            },
        });
        
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
                                @lang('words.opportunity-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.opportunity-add')</h4>
                            </div>
                            <form id="opportunity_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('words.opportunity-title')</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="form-group">
                                            <label>@lang('words.opportunity-product')</label>
                                            <select class="select2 form-control" id="product_id">
                                                @foreach ($_products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label for="fp-date-time">@lang('words.opportunity-end-date-label')</label>
                                            <input type="text" id="end" class="form-control flatpickr-date-time" placeholder="YYYY-AA-GG SS:DD" />
                                    </div>
                                    <div class="form-group">
                                        <label for="image">@lang('words.opportunity-image')</label>
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