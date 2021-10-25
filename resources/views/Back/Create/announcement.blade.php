@extends('Back.main')
@section('title')
@lang('words.announcement-add')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#add").on("click",function(e){
        e.preventDefault()
        var title = $("#title").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('Announcement.add') }}",
            data: {title:title},
            dataType: 'json',
            success: function (data) {
                $("#announ_form")[0].reset();
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
                                @lang('words.announcement-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.announcement-add')</h4>
                            </div>
                            <form id="announ_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">@lang('words.announcement-title')</label>
                                        <input type="text" class="form-control" id="title">
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