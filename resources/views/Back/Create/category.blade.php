@extends('Back.main')
@section('title')
@lang('words.category-add')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#add").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("main", $("#main").val());
        formData.append("name", $("#name").val());
        formData.append("image", $("#image").prop("files")[0]);
        formData.append("add", "add");
        $.ajax({
            type: 'POST',
            url: "{{ route('Category.add') }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#add").attr("disabled", true)
                $("#category_form")[0].reset();
                setTimeout(function () {
                    location.reload()
                }, 1000)
                toastr.success('', data.success, { positionClass: "toast-bottom-right" })
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
                                @lang('words.category-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.category-add')</h4>
                            </div>
                            <form id="category_form">
                                <div class="card-body">
                                    <div class="form-group">
                                            <label>@lang('words.main-menu')</label>
                                            <select class="select2 form-control" id="main">
                                                <option value="0" selected>@lang('words.not')</option>
                                                @foreach ($subs as $sub)
                                                <option value="{{ $sub->id }}">{{ App\Models\Category::getParentsTree($sub, $sub->title) }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">@lang('words.category-name')</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">@lang('words.category-image')</label>
                                        <input type="file" class="form-control" id="image" multiple>
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