@extends('Web.main')
@section('title')
{{ $settings->title }} | {{ $category }}
@endsection
@section('script')
<script>
    $(document).ready(function () {
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
                    @if ($products->count() > false)
                        <div class="col-lg-12">
                            <div class="shop-product-fillter">
                                <div class="sort-by-product-area">
                                    <div class="sort-by-cover mr-10">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps"></i>Show:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">50</a></li>
                                                <li><a href="#">100</a></li>
                                                <li><a href="#">150</a></li>
                                                <li><a href="#">200</a></li>
                                                <li><a href="#">All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">Featured</a></li>
                                                <li><a href="#">Price: Low to High</a></li>
                                                <li><a href="#">Price: High to Low</a></li>
                                                <li><a href="#">Release Date</a></li>
                                                <li><a href="#">Avg. Rating</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row product-grid-3">
                            @foreach ($products as $product)
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
                                                    <div class="product-rating" style="width:40%">
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
                        </div>
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{ $products->links('vendor.pagination.custom') }}
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