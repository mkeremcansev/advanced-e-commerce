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