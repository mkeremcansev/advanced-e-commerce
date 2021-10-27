@extends('Web.main')
@section('title')
{{ $settings->title." - ".$single->title }}
@endsection
@section('script')
<script>
    $("#add-cart").on("click",function(e){
        let btnId = $("#add-cart")
        btnId.text('@lang("words.loading")');
        btnId.addClass('cwDisabled')
        btnId.attr("disabled", true)
        e.preventDefault()
        let active = [];
        let variant = '{{ $single->getVariant->count() }}';
        let product = '{{ $single->hash }}';
        let quantity = $('#quantity').text();
        $('ul .active').each(function() { 
            active.push($(this).attr('value')); 
        }); 
            $.ajax({
                type: 'POST',
                url: "{{ route('Web.Cart.add') }}",
                data: { data: active, product:product, quantity:quantity },
                dataType: 'json',
                success: function (data) {
                    if(data.message != null && data.message.length == variant) {
                        setTimeout(function(){
                            iziToast.success({
                                message: '@lang("words.cart-add-success")'
                            });
                            btnId.text('@lang("words.cart-add")');
                            btnId.attr("disabled", false);
                            btnId.removeClass('cwDisabled');
                            $("#cwCart span").html(data.cart)
                        }, 1000)
                        
                    } else {
                        setTimeout(function(){
                            iziToast.error({
                            message: '@lang("words.cart-product-selected")'
                            });
                            btnId.text('@lang("words.cart-add")');
                            btnId.attr("disabled", false);
                            btnId.removeClass('cwDisabled');
                        }, 400)
                    }
                },
                error: function (data) {
                    setTimeout(function(){
                        iziToast.error({
                            message: validateItem(data)
                        });
                            btnId.text('@lang("words.cart-add")');
                            btnId.attr("disabled", false);
                            btnId.removeClass('cwDisabled');
                    }, 400)
                    
                },
            });
        });

$('#add-wishlist').on('click', function(){
    let product = '{{ $single->hash }}';
    let btnId = $('#add-wishlist');
    btnId.addClass('cwDisabled')
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
})

$('#add-compare').on('click', function(){
    let product = '{{ $single->hash }}';
    let btnId = $('#add-compare');
    btnId.addClass('cwDisabled')
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
})
</script>                                    
@endsection
@section('content')
<main class="main">
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <!-- flex-row-reverse add left listing -->
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <div class="product-image-slider">
                                        @foreach (allItems($single->images) as $productImages)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($productImages) }}" alt="{{ $single->title }}">
                                        </figure>
                                        @endforeach
                                    </div>
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach (allItems($single->images) as $productImages)
                                        <div><img src="{{ asset($productImages) }}" alt="{{ $single->title }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ $single->title }}</h2>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:40%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (25 yorum)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            @if ($single->discount == 0)
                                            <ins><span class="text-brand">{{ priceToFormat($single->price) }} ₺</span></ins>
                                            @else
                                            <ins><span class="text-brand">{{ priceToFormat($single->discount) }} ₺</span></ins>
                                            <ins><span class="old-price font-md ml-15">{{ priceToFormat($single->price) }} ₺</span></ins>
                                            <span
                                                class="save-price  font-md color3 ml-15">{{ discount($single->price, $single->discount) }}%
                                                @lang('words.discounted')</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-heart mr-5"></i> @lang('words.happy-customer')</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> @lang('words.30-day-return')</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> @lang('words.cash-on-security')</li>
                                        </ul>
                                    </div>
                                    @foreach ($single->getVariant as $variant)
                                        <div class="attr-detail attr-size mb-2">
                                            <strong class="mr-10">{{ $variant->title }}</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach ($variant->getVariantValue as $value)
                                                    @if ($value->stock == 0)
                                                        <li class="cwDisabled"><del class="canseworksRed"><a>{{ $value->title }}</a></del></li>
                                                    @else
                                                        @if ($value->price == 0)
                                                            <li value="{{ $value->hash }}"><a class="hover-up"><span>{{ $value->title }}</span></a></li>
                                                        @else
                                                            <li value="{{ $value->hash }}"><a class="hover-up"><span>{{ $value->title }}<span style="font-weight: bold;"> +{{ $value->price }} ₺</span></a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span id="quantity" class="qty-val canseworksMR100">1</span>
                                            <a class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button id="add-cart" type="button" class="button button-add-to-cart hover-up">@lang('words.cart-add')</button>
                                            <a id="add-wishlist" class="action-btn hover-up"><i class="fi-rs-heart"></i></a>
                                            <a id="add-compare" class="action-btn hover-up"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                        href="#Description">@lang('words.product-desc')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                        href="#Additional-info">@lang('words.product-info')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                        href="#Reviews">@lang('words.product-reviews')</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $single->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        @if ($single->getInformation->count() > 0)
                                        <tbody>
                                            @foreach ($single->getInformation as $information)
                                            <tr>
                                                <th>{{ $information->title }}</th>
                                                <td>
                                                    <p>{{ $information->description }}</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <tr>
                                            <th>
                                                @lang('words.product-not-info')
                                            </th>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <table class="font-md">
                                        <tr>
                                            <th>
                                                @lang('words.product-not-review')
                                            </th>
                                        </tr>
                                    </table>
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('Web') }}/assets/imgs/page/avatar-6.jpg"
                                                                    alt="">
                                                                <h6><a href="#">Jacky Chan</a></h6>
                                                                <p class="font-xxs">Since 2012</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Thank you very fast shipping from Poland only 3days.
                                                                </p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at
                                                                            3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply
                                                                            <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('Web') }}/assets/imgs/page/avatar-7.jpg"
                                                                    alt="">
                                                                <h6><a href="#">Ana Rosie</a></h6>
                                                                <p class="font-xxs">Since 2008</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Great low price and works well.</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at
                                                                            3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply
                                                                            <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('Web') }}/assets/imgs/page/avatar-8.jpg"
                                                                    alt="">
                                                                <h6><a href="#">Steven Keny</a></h6>
                                                                <p class="font-xxs">Since 2010</p>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:90%">
                                                                    </div>
                                                                </div>
                                                                <p>Authentic and Beautiful, Love these way more than
                                                                    ever expected They are Great earphones</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at
                                                                            3:12 pm </p>
                                                                        <a href="#" class="text-brand btn-reply">Reply
                                                                            <i class="fi-rs-arrow-right"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--single-comment -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%;"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;"
                                                        aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%;"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%
                                                    </div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%;"
                                                        aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%
                                                    </div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment"
                                                                    id="comment" cols="30" rows="9"
                                                                    placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name"
                                                                    type="text" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email"
                                                                    type="email" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website"
                                                                    type="text" placeholder="Website">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Related products</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html" tabindex="0">
                                                        <img class="default-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-2-1.jpg"
                                                            alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-2-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html" tabindex="0"><i
                                                            class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html" tabindex="0"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="shop-product-right.html" tabindex="0">Ulstra Bass
                                                        Headphone</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$238.85 </span>
                                                    <span class="old-price">$245.8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html" tabindex="0">
                                                        <img class="default-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-3-1.jpg"
                                                            alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-4-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html" tabindex="0"><i
                                                            class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html" tabindex="0"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="sale">-12%</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="shop-product-right.html" tabindex="0">Smart Bluetooth
                                                        Speaker</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$138.85 </span>
                                                    <span class="old-price">$145.8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html" tabindex="0">
                                                        <img class="default-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-4-1.jpg"
                                                            alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-4-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html" tabindex="0"><i
                                                            class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html" tabindex="0"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="new">New</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="shop-product-right.html" tabindex="0">HomeSpeak 12UEA
                                                        Goole</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$738.85 </span>
                                                    <span class="old-price">$1245.8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up mb-0">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html" tabindex="0">
                                                        <img class="default-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-5-1.jpg"
                                                            alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('Web') }}/assets/imgs/shop/product-3-2.jpg"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                            class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html" tabindex="0"><i
                                                            class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html" tabindex="0"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="shop-product-right.html" tabindex="0">Dadua Camera 4K
                                                        2021EF</a></h2>
                                                <div class="rating-result" title="90%">
                                                    <span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    <span>$89.8 </span>
                                                    <span class="old-price">$98.8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">@lang('words.new-products')</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        @foreach ($_products->sortByDesc('id')->take(5) as $new)
                            <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset(firstImage($new->images)) }}" alt="{{ $new->slug }}">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="{{ route('Web.product.single', $new->slug) }}">{{ $new->title }}</a></h6>
                                @if ($new->discount != 0)
                                    <span>{{ $new->discount }} ₺</span>
                                    <del><span>{{ $new->price }} ₺</span></del>
                                @else
                                    <span>{{ $new->price }} ₺</span>
                                @endif
                                
                                <div class="product-rate">
                                    <div class="product-rating" style="width:60%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">@lang('words.popular-products')</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        @foreach ($_products->sortByDesc('hit')->take(5) as $popular)
                            <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset(firstImage($popular->images)) }}" alt="{{ $popular->slug }}">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="{{ route('Web.product.single', $popular->slug) }}">{{ $popular->title }}</a></h6>
                                @if ($popular->discount != 0)
                                    <span>{{ $popular->discount }} ₺</span>
                                    <del><span>{{ $popular->price }} ₺</span></del>
                                @else
                                    <span>{{ $popular->price }} ₺</span>
                                @endif
                                <div class="mb-1 cwFWB">
                                    <i class="fa fa-eye"></i><span class="ml-1">{{ $popular->hit }}</span>
                                </div>
                                
                                <div class="product-rate">
                                    <div class="product-rating" style="width:60%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection