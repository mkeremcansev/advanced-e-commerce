@extends('Panel.main')
@section('title')
@lang('words.product-list')
@endsection
@section('script')
@if ($message = Session::get('success'))
<script>
    toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
</script>
@elseif($message = Session::get('error'))
<script>
    toastr.error('', "{{ $message }}", { positionClass: "toast-bottom-right" })
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
            <section id="responsive-datatable">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">@lang('words.product-list')</h4>
                                <a href="{{ route('Panel.product.add') }}"
                                    class="btn btn-primary waves-effect waves-float waves-light">@lang('words.product-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="product_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.product-image')</th>
                                            <th>@lang('words.product-name')</th>
                                            <th>@lang('words.product-category')</th>
                                            <th>@lang('words.product-brand')</th>
                                            <th>@lang('words.product-code')</th>
                                            <th>@lang('words.product-price')</th>
                                            <th>@lang('words.product-stock')</th>
                                            <th>@lang('words.status')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td></td>
                                            <td><img width="100" src="{{ asset(firstImage($product->images)) }}"></td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ App\Models\Category::getParentsTree($product->getCategory, $product->getCategory->title) }}</td>
                                            <td>{{ $product->getBrand->title }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>
                                                @if ($product->discount != 0)
                                                <span>{{ priceToFormat($product->discount) }} ₺</span>
                                                <span><del>{{ priceToFormat($product->price) }} ₺</del></span>
                                                @else
                                                <span>{{ priceToFormat($product->price) }} ₺</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->getVariant->count() > 0)
                                                @foreach ($product->getVariant as $variant)
                                                <li>
                                                    <h5>{{ $variant->title }}</h5>
                                                    @foreach ($variant->getVariantValue as $value)
                                                    @if ($value->stock == 0)
                                                    <del class="cw-red-color-1">{{ $value->title }}({{ $value->stock }}),</del>
                                                    @else
                                                    <span>{{ $value->title }}({{ $value->stock }}),</span>
                                                    @endif
                                                    @endforeach
                                                </li>
                                                @endforeach
                                                @else
                                                <h5 class="cw-red-color-1 cw-fwb-1">@lang('words.product-stock-not')</h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->status == '1')
                                                <span class="cw-green-color-1 cw-fwb-1">@lang('words.active')</span>
                                                @else
                                                <span class="cw-red-color-1 cw-fwb-1">@lang('words.passive')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Panel.Product.update.get', $product->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-warning" href="{{ route('Panel.Variant.add.get', $product->id) }}">@lang('words.variation')</a>
                                                        <a class="dropdown-item text-info" href="{{ route('Panel.Information.add.get', $product->id) }}">@lang('words.product-information')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Panel.Product.delete', $product->id) }}">@lang('words.delete')</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection