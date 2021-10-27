@extends('Web.main')
@section('title')
{{ $settings->title }} - @lang('words.my-favorite')
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
        @if (Cart::instance('wishlist')->content()->count() > 0)
            <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean cwTableBorder">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">@lang('words.product-image')</th>
                                        <th scope="col">@lang('words.product-name')</th>
                                        <th scope="col">@lang('words.product-price')</th>
                                        <th scope="col">@lang('words.delete')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('wishlist')->content() as $wishlist)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset(firstImage($wishlist->model->images)) }}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{ route('Web.product.single', $wishlist->model->slug) }}">{{ $wishlist->model->title }}</a></h5>
                                            <p class="font-xs canseworksFontWeight">@foreach (json_decode($wishlist->options, true) as $key => $option) {{ "(".$key . ' : ' . $option.") "}} @endforeach</p>
                                        </td>
                                        <td class="price"><span>
                                            @if ($wishlist->model->discount != 0)
                                                {{ priceToFormat($wishlist->model->discount) }} ₺
                                                <del>{{ priceToFormat($wishlist->model->price) }} ₺</del>
                                            @else
                                                {{ priceToFormat($wishlist->model->price) }} ₺
                                            @endif
                                            
                                        </span></td>
                                        <td class="action"><a href="{{ route('Web.Wishlist.delete', $wishlist->rowId) }}" class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
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
                        <img width="200" src="{{ asset('Web/assets/imgs/custom/basket.gif') }}" alt="">
                        <h4 class="mt-2">@lang('words.wishlist-empty')</h4>
                        <a href="{{ route('Web.main') }}" class="btn mr-10 mb-sm-15 mt-3 cwFontSize12">@lang('words.home')</a>
                        </div>
                    </center>
                </div>
            </div>
        </section>
        @endif
        
    </main>
@endsection