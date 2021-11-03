@extends('Web.main')
@section('title')
{{ $settings->title }} | {{ $campaign->title }}
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.shop-product-fillter-header').hide();
        $('.add-wishlist-cw').on('click', function(){
            let thisItem = $(this);
            let product = thisItem.attr('wishlist-hash');
            let btnId = $('.add-wishlist-cw');
            btnId.addClass('cwDisabled');
            $.ajax({
                type: 'POST',
                url: "{{ route('Web.Wishlist.add') }}",
                data: { product:product },
                dataType: 'json',
                success: function (data) {
                    setTimeout(function() {
                        iziToast.success({
                            message: data.message
                        });
                        btnId.removeClass('cwDisabled');
                        $("#cwWishlist span").html(data.wishlist)
                    }, 1000)
                },
                error: function (data) {
                setTimeout(function(){
                    iziToast.error({
                        message: validateItem(data)
                    });
                        btnId.removeClass('cwDisabled');
                }, 400)
                    
                },
            });
        });
        $('.add-compare-cw').on('click', function(){
            let product = $(this).attr('compare-hash');
            let btnId = $('.add-compare-cw');
            btnId.addClass('cwDisabled');
            $.ajax({
                type: 'POST',
                url: "{{ route('Web.Compare.add') }}",
                data: { product:product },
                dataType: 'json',
                success: function (data) {
                    setTimeout(function() {
                        iziToast.success({
                            message: data.message
                        });
                        btnId.removeClass('cwDisabled');
                        $("#cwCompare span").html(data.compare)
                    }, 1000)
                },
                error: function (data) {
                setTimeout(function(){
                    iziToast.error({
                        message: validateItem(data)
                    });
                        btnId.removeClass('cwDisabled');
                }, 400)
                    
                },
            });
        });
    });
</script>
@endsection
@section('content')
<main class="main">
    <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    @if ($values->count() > false)
                    <div class="col-lg-4 mb-15">
                        <a class="shop-filter-toogle cwFWB">
                            <span class="fi-rs-filter mr-5"></span>
                            @lang('words.filter')
                            <i class="fi-rs-angle-small-down angle-down"></i>
                            <i class="fi-rs-angle-small-up angle-up"></i>
                        </a>
                         <form action="" method="GET">
                            <div class="shop-product-fillter-header">
                                <div class="row">
                                    <h5 class="mb-20">@lang('words.price')</h5>
                                    <div class="col-lg-6 col-md-4 mb-lg-0 mb-md-5 mb-sm-5">
                                        <input type="text" class="form-control" name="min" placeholder="@lang('words.least')">
                                    </div>
                                    <div class="col-lg-6 col-md-4 mb-lg-0 mb-md-5 mb-sm-5">
                                        <input type="text" class="form-control" name="max" placeholder="@lang('words.most')">
                                    </div>
                                </div>
                                <button type="submit" class="button button-add-to-cart hover-up col-lg-12 cwWidth100 mt-15 text-center">@lang('words.filter-go')</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <div class="row product-grid-3">
                            @foreach ($values as $value)
                                @foreach ($value->getCampaignValueProducts as $product)
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('Web.product.single', $product->slug) }}">
                                                        <img class="default-img" src="{{ asset(firstImage($product->images)) }}" alt="{{ $product->slug }}">
                                                        <img class="hover-img" src="{{ asset(twoImage($product->images)) }}">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="@lang('words.add-to-wishlist')" wishlist-hash="{{ $product->hash }}" class="action-btn hover-up add-wishlist-cw color-white"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="@lang('words.add-to-compare')" compare-hash="{{ $product->hash }}" class="action-btn hover-up add-compare-cw color-white"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="{{ route('Web.product.single', $product->slug) }}">{{ $product->title }}</a></h2>
                                                <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:{{ $product->getProductReviews->avg('rating')*20 }}%">
                                                        </div>
                                                    </div>
                                                <div class="product-price">
                                                    @if ($product->discount == 0)
                                                        <span>{{ priceToFormat($product->price) }} ₺</span>
                                                    @else
                                                        <span>{{ priceToFormat($product->discount) }} ₺</span><br>
                                                        <span class="old-price mlCanseworks">{{ priceToFormat($product->price) }} ₺</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-1 show">
                                                    <a aria-label="@lang('words.detail')" class="action-btn hover-up" href="{{ route('Web.product.single', $product->slug) }}"><i class="fi-rs-arrow-right color-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{ $values->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                    @else
                    <div class="col-lg-12">
                        <center>
                            <img width="200" src="{{ asset('Web/assets/imgs/custom/basket.gif') }}" alt="">
                            <h4 class="mt-2">@lang('words.category-not-product')</h4>
                            <a href="{{ route('Web.main') }}" class="btn mr-10 mb-sm-15 mt-3 cwFontSize12">@lang('words.home')</a>
                        </center>
                    </div>
                    @endif
                </div>
            </div>
        </section>
</main>
@endsection