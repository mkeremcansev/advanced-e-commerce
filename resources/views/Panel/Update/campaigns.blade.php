@extends('Panel.main')
@section('title')
@lang('words.campaign-edit')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#update").on("click",function(e){
        e.preventDefault()
        var formData = new FormData();
        formData.append("title", $("#title").val());
        if($("#image").prop("files").length == 0) {
            formData.append("image", "");
        } else {
            formData.append("image", $("#image").prop("files")[0]);
            formData.append("update", "update");
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('Panel.Campaign.update', $campaign->id) }}",
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                toastr.success('', data.success, { positionClass: "toast-bottom-right" })
                setTimeout(function () {
                    var url = "{{ route('Panel.Campaign.add.get', ":id") }}";
                    url = url.replace(':id', data.campaign);
                    window.location.href=url;
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
                                @lang('words.campaign-add-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.campaign-edit') ( {{ $campaign->title }} )</h4>
                            </div>
                            <form id="brand_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('words.campaign-title')</label>
                                        <input type="text" class="form-control" id="title" value="{{ $campaign->title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="image">@lang('words.campaign-image')</label>
                                        <input type="file" class="form-control" id="image">
                                    </div>

                                    <div class="form-group" id="updated_image">
                                        <label for="customFile">@lang('words.updated-image')</label>
                                        <div class="custom-file">
                                        <img width="120" src="{{ asset($campaign->image) }}">
                                        </div>
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