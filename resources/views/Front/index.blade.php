@extends('Front.main')
@section('title')
{{ $settings->title }}
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
            url: "{{ route('Wishlist.add') }}",
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
            url: "{{ route('Compare.add') }}",
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
@if ($message = Session::get('success'))
    <script>
        iziToast.success({
            message: "{{ $message }}"
        });
    </script>
@elseif ($message = Session::get('error'))
<script>
        iziToast.error({
            message: "{{ $message }}"
        });
    </script>
@endif
@endsection
@section('content')
<main class="main">
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                @foreach ($services as $service)
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up animated">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                        <h4 style="background-color: {{ $service->color }};">{{ $service->title }}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
<section class="deals">
        <div class="container">
            <div class="row">
                @foreach ($_opportunitys as $opportunity)
                <div class="col-lg-6 deal-co mb-4">
                    <div class="deal wow fadeIn animated mb-md-4 mb-sm-4 mb-lg-0"
                        style="background-image: url('{{ asset($opportunity->image) }}');">
                        <div class="deal-top">
                            <h2 class="text-brand">{{ $opportunity->title }}</h2>
                        </div>
                        <div class="deal-content">
                            <h6 class="product-title"><a href="{{ route('Front.product.single', $opportunity->getOpportunityProduct->slug) }}">{{ $opportunity->getOpportunityProduct->title }}</a></h6>
                            <div class="product-price"><span style="color: #f27a1a; font-weight: bold;" class="new-price">{{ priceToFormat($opportunity->getOpportunityProduct->discount) }} ₺</span><span style="color: black;" class="old-price">{{ priceToFormat($opportunity->getOpportunityProduct->price) }} ₺</span></div>
                        </div>
                        <div class="deal-bottom">
                            <div class="deals-countdown" data-countdown="{{ $opportunity->end }}"></div>
                            <a href="{{ route('Front.product.single', $opportunity->getOpportunityProduct->slug) }}" class="btn hover-up">Şimdi Satın Al! <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="pt-25 pb-20">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span></span>@lang('words.popular-products')</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows">
                </div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @foreach ($_products->sortByDesc('hit') as $product) 
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('Front.product.single', $product->slug) }}">
                                        <img class="default-img" src="{{ asset(firstImage($product->images)) }}" alt="{{ $product->title }}">
                                        <img class="hover-img" src="{{ asset(twoImage($product->images)) }}" alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="@lang('words.add-to-wishlist')" wishlist-hash="{{ $product->hash }}" class="action-btn small hover-up add-wishlist-cw" tabindex="0"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="@lang('words.add-to-compare')" compare-hash="{{ $product->hash }}" class="action-btn small hover-up add-compare-cw" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ route('Front.product.single', $product->slug) }}">{{ $product->title }}</a></h2>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @foreach ($_campaigns as $campaign)
    <section class="section-padding">
        <div class="container pt-15 pb-25">
            <div class="heading-tab d-flex">
                <div class="heading-tab-left wow fadeIn animated">
                    <h3 class="section-title mb-20"><span></span>{{ $campaign->title }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex">
                    <div class="banner-img style-2 wow fadeIn animated">
                        <img src="{{ asset($campaign->image) }}" alt="">
                        <div class="banner-text">
                            <h4 class="mt-5">{{ $campaign->title }}</h4>
                            <a href="shop-grid-right.html" class="text-white">Tümünü gör <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="tab-content wow fadeIn animated">
                        <div class="tab-pane fade show active">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                    id="{{ $campaign->slug }}-arrows"></div>
                                <div class="carausel-4-columns carausel-arrow-center" id="{{ $campaign->slug }}">
                                    @foreach ($campaign->getCampaignValue as $value)
                                    <div class="product-cart-wrap mb-1">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('Front.product.single', $value->getCampaignValueProduct->slug) }}">
                                                    <img class="default-img" src="{{ asset(firstImage($value->getCampaignValueProduct->images)) }}" alt="{{ $value->getCampaignValueProduct->title }}">
                                                    <img class="hover-img" src="{{ asset(twoImage($value->getCampaignValueProduct->images)) }}" alt="{{ $value->getCampaignValueProduct->title }}">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="@lang('words.add-to-wishlist')" class="action-btn small hover-up add-wishlist-cw" wishlist-hash="{{ $value->getCampaignValueProduct->hash }}" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="@lang('words.add-to-compare')" class="action-btn small hover-up add-compare-cw" compare-hash="{{ $value->getCampaignValueProduct->hash }}" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="{{ route('Front.product.single', $value->getCampaignValueProduct->slug) }}">{{ $value->getCampaignValueProduct->title }}</a></h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:40%">
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                @if ($value->getCampaignValueProduct->discount == 0)
                                                    <span>{{ priceToFormat($value->getCampaignValueProduct->price) }} ₺</span>
                                                @else
                                                    <span>{{ priceToFormat($value->getCampaignValueProduct->discount) }} ₺</span><br>
                                                    <span class="old-price mlCanseworks">{{ priceToFormat($value->getCampaignValueProduct->price) }} ₺</span>
                                                @endif
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="@lang('words.detail')" class="action-btn hover-up" href="{{ route('Front.product.single', $value->getCampaignValueProduct->slug) }}"><i class="fi-rs-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                     @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <section class="mb-45">
        <div class="container">
            <div class="row">
                @foreach ($_category as $category)
                    <div class="col-lg-3 col-md-6 mb-sm-5 mb-md-0">
                        <h4 class="section-title style-1 mb-30 wow fadeIn animated">{{ $category->title }}</h4>
                        <div class="product-list-small wow fadeIn animated">
                            @foreach ($category->getCategoryProductIndex->sortByDesc('hit')->take(3) as $product)
                                <article class="row align-items-center">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{ route('Front.product.single', $product->slug) }}">
                                        <img src="{{ asset(firstImage($product->images)) }}" alt=""></a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <h4 class="title-small">
                                            <a href="{{ route('Front.product.single', $product->slug) }}">{{ $product->title }}</a>
                                        </h4>
                                        <div class="product-price">
                                                @if ($product->discount == 0)
                                                    <span>{{ priceToFormat($product->price) }} ₺</span>
                                                @else
                                                    <span>{{ priceToFormat($product->discount) }} ₺</span><br>
                                                    <span class="old-price mlCanseworks">{{ priceToFormat($product->price) }} ₺</span>
                                                @endif
                                            </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection