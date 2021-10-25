@extends('Back.main')
@section('title')
{{ $value->title }}
@endsection
@section('script')
<script>
$(document).ready(function () {
    $("#update").click(function(e){
        var title = $('#title').val();
        var option_title = $('#option_title').val();
        var option_stock = $('#option_stock').val();
        var option_price = $('#option_price').val();
        $.ajax({
            type: 'post',
            url: "{{ route('Variant.update', $value->id) }}",
            data: {title:title, option_title:option_title, option_stock:option_stock, option_price:option_price},
            dataType: 'json',
            success: function (data) {
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
            <section class="form-control-repeater">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body">
                                @lang('words.value-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><a href="{{ route('Variant.add.get',$value->getVariantProduct->id) }}"><i data-feather="arrow-left"></i> @lang('words.option-back')</a></h4>
                            </div>
                            <div class="card-body">
                                <form class="invoice-repeater">
                                    <div class="form-group">
                                        <label for="itemname">@lang('words.variation-name')</label>
                                        <input type="text" class="form-control" id="title" value="{{ $value->getVariantMain->title }}"/>
                                    </div>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="">@lang('words.option-name')</label>
                                                    <input type="text" class="form-control" id="option_title" value="{{ $value->title }}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="">@lang('words.option-stock')</label>
                                                    <input type="number" class="form-control" id="option_stock" min="0" value="{{ $value->stock }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="">@lang('words.option-price')</label>
                                                    <input type="number" class="form-control" id="option_price" min="0" value="{{ $value->price }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    <button type="button" id="update" class="btn btn-primary waves-effect waves-float waves-light mb-1 mt-1 float-right">@lang('words.save')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection