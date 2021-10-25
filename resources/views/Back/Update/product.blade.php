@extends('Back.main')
@section('title')
@lang('words.product-edit') ({{ $product->title }})
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#update').click(function () {
            var formData = new FormData();
            var totalfiles = document.getElementById('images').files.length;
            for (var index = 0; index < totalfiles; index++) {
                formData.append("images[]", document.getElementById('images').files[index]);
            }
            CKEDITOR.replace("description");
            formData.append("title", $("#title").val());
            formData.append("category_id", $("#category_id").val());
            formData.append("brand_id", $("#brand_id").val());
            formData.append("description", CKEDITOR.instances.description.getData());
            formData.append("price", $("#price").val());
            formData.append("discount", $("#discount").val());
            formData.append("update", "update");
            $.ajax({
                url: '{{ route("Product.update", $product->id) }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#update").attr("disabled", true)
                    toastr.success('', data.success, { positionClass: "toast-bottom-right" })
                    setTimeout(function () {
                        var url = "{{ route('Variant.add.get', ":id") }}";
                        url = url.replace(':id', data.product);
                        window.location.href = url;
                    }, 1000)
                    console.log(data.product)
                },
                error: function (data) {
                    toastr.error('', validateItem(data), { positionClass: "toast-bottom-right" })
                },
            });

        });
    });
</script>
@if ($message = Session::get('error'))
<script>
    toastr.error('', "{{ $message }}", { positionClass: "toast-bottom-right" })
</script>
@endif
@if ($message = Session::get('success'))
<script>
    toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
</script>
@endif
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
                                @lang('words.product-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.product-edit') ( {{ $product->title }} )</h4>
                                <a href="{{ route('Variant.add.get', $product->id) }}"
                                    class="btn btn-success waves-effect waves-float waves-light">@lang('words.variation')</a>
                            </div>
                            <form id="product_form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_name">@lang('words.product-name')</label>
                                        <input type="text" class="form-control" id="title"
                                            value="{{ $product->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('words.product-category')</label>
                                        <select class="select2 form-control" id="category_id">
                                            <option value="" selected>@lang('words.not')</option>
                                            @foreach ($subs as $sub)
                                            <option value="{{ $sub->id }}" @if ($sub->id == $product->category_id)
                                                selected @endif>{{ App\Models\Category::getParentsTree($sub,
                                                $sub->title) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('words.product-brand')</label>
                                        <select class="select2 form-control" id="brand_id">
                                            @foreach ($brands as $brand)
                                            <option @if($product->brand_id == $brand->id) selected @endif value="{{
                                                $brand->id }}">{{ $brand->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_name">@lang('words.product-description')</label>
                                        <textarea type="text" class="form-control ckeditor"
                                            id="description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_name">@lang('words.product-price')</label>
                                        <input type="text" class="form-control" id="price"
                                            value="{{ $product->price }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name">@lang('words.product-discount-price')</label>
                                        <div class="badge badge-light-success">@lang('words.product-discount-alert')
                                        </div>
                                        <input type="text" class="form-control" id="discount"
                                            value="{{ $product->discount }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name">@lang('words.product-image')</label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                                    </div>

                                    <button type="button" id="update"
                                        class="btn btn-primary waves-effect waves-float waves-light mt-2 mb-2 float-right">@lang('words.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.product-images')</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach (allItems($product->images) as $image)
                                    <div class="col-md-4 col-6">
                                        <img src="{{ asset($image) }}" class="img-fluid rounded mb-1" />
                                        <form id="imageDelete"
                                            action="{{ route('Product.update.image', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="image" value="{{ $image }}">
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-danger waves-effect waves-float waves-light mb-1 center">@lang('words.delete')</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection