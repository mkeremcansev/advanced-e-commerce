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
                            <a href="{{ route('Web.campaign.products', $campaign->slug) }}" class="text-white">@lang('words.all-see')<i class="fi-rs-arrow-right color-white"></i></a>
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
                                        @foreach ($value->getCampaignValueProducts as $product)
                                            <div class="product-cart-wrap mb-1">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{ route('Web.product.single', $product->slug) }}">
                                                            <img class="default-img" src="{{ asset(firstImage($product->images)) }}" alt="{{ $product->title }}">
                                                            <img class="hover-img" src="{{ asset(twoImage($product->images)) }}" alt="{{ $product->title }}">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="@lang('words.add-to-wishlist')" class="action-btn small hover-up add-wishlist-cw" wishlist-hash="{{ $product->hash }}" tabindex="0"><i class="fi-rs-heart color-white"></i></a>
                                                        <a aria-label="@lang('words.add-to-compare')" class="action-btn small hover-up add-compare-cw" compare-hash="{{ $product->hash }}" tabindex="0"><i class="fi-rs-shuffle color-white"></i></a>
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
                                        @endforeach
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