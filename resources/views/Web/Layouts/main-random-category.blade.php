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
                                    <a href="{{ route('Web.product.single', $product->slug) }}">
                                    <img src="{{ asset(firstImage($product->images)) }}" alt=""></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h4 class="title-small">
                                        <a href="{{ route('Web.product.single', $product->slug) }}">{{ $product->title }}</a>
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