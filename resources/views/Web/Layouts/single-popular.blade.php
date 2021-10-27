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