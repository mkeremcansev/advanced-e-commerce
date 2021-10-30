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
                                    <a href="{{ route('Web.product.single', $product->slug) }}">
                                        <img class="default-img" src="{{ asset(firstImage($product->images)) }}" alt="{{ $product->title }}">
                                        <img class="hover-img" src="{{ asset(twoImage($product->images)) }}" alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="@lang('words.add-to-wishlist')" wishlist-hash="{{ $product->hash }}" class="action-btn small hover-up add-wishlist-cw" tabindex="0"><i class="fi-rs-heart color-white"></i></a>
                                    <a aria-label="@lang('words.add-to-compare')" compare-hash="{{ $product->hash }}" class="action-btn small hover-up add-compare-cw" tabindex="0"><i class="fi-rs-shuffle color-white"></i></a>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>