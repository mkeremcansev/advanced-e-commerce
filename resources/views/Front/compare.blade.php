@extends('Front.main')
@section('title')
{{ $settings->title }} - @lang('words.my-compare')
@endsection
@section('script')
@if ($message = Session::get('success'))
    <script>
        iziToast.success({
            message: "{{ $message }}"
        });
    </script>
@endif
@endsection
@section('content')
<main class="main">
    @if (Cart::instance('compare')->content()->count() > 0)
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <tbody>
                                    <tr class="pr_image">
                                        <td class="text-muted font-md fw-600">@lang('words.product-image')</td>
                                        @foreach (Cart::instance('compare')->content() as $compare)
                                        <td class="row_img"><img width="200" src="{{ asset(firstImage($compare->model->images)) }}" alt="{{ $compare->model->title }}"></td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_title">
                                        <td class="text-muted font-md fw-600">@lang('words.product-name')</td>
                                        @foreach (Cart::instance('compare')->content() as $compare)
                                        <td class="product_name">
                                            <h5><a href="{{ route('Front.product.single', $compare->model->slug) }}">{{ $compare->model->title }}</a></h5>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_price">
                                        <td class="text-muted font-md fw-600">@lang('words.product-price')</td>
                                        @foreach (Cart::instance('compare')->content() as $compare)
                                        <td class="product_price">
                                            <span class="price">
                                                @if ($compare->model->discount != 0)
                                                {{ priceToFormat($compare->model->discount) }} ₺
                                                <del>{{ priceToFormat($compare->model->price) }} ₺</del>
                                                @else
                                                    {{ priceToFormat($compare->model->price) }} ₺
                                                @endif
                                            </span></td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_remove text-muted">
                                        <td class="text-muted font-md fw-600">@lang('words.delete')</td>
                                        @foreach (Cart::instance('compare')->content() as $compare)
                                        <td class="row_remove">
                                            <a href="{{ route('Compare.delete', $compare->rowId) }}"><i class="fi-rs-trash mr-5"></i></a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @else
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <center>
                        <div class="col-12">
                        <img width="200" src="{{ asset('Front/assets/imgs/custom/basket.gif') }}" alt="">
                        <h4 class="mt-2">@lang('words.compare-empty')</h4>
                        <a href="{{ route('Front.main') }}" class="btn mr-10 mb-sm-15 mt-3 cwFontSize12">@lang('words.home')</a>
                        </div>
                    </center>
                </div>
            </div>
        </section>
    @endif
    
</main>
@endsection