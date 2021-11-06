@extends('Web.main')
@section('title')
{{ setting('title') }} | @lang('words.my-cart')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.quantity-val').on('change',function name(e) {
        let thisItem = $(this);
        let dataId = thisItem.attr('data-id')
        let url = "{{ route('Web.Cart.update', ":id") }}";
        url = url.replace(':id', dataId);
        let quantity = $('#quantity-'+dataId+'').val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {quantity:quantity},
            dataType: 'json',
            success: function (data) {
                iziToast.success({
                    message: data.message
                });
                $(".price #price-"+data.id+"").html(data.price+' ₺')
                $(".subtotal span").html(data.subtotal+' ₺')
                $(".tax span").html('%18 ('+data.tax+' ₺ )')
                $(".total span").html(data.total+' ₺')
            },
            error: function (data) {
                console.log('@lang("words.error")')
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
@elseif($message = Session::get('error'))
    <script>
        iziToast.error({
            message: "{{ $message }}"
        });
    </script>
@endif
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<script>
    iziToast.options = {
                "preventDuplicates": true
            }
            iziToast.error({
            message: "{{ $error }}"
        });
</script>
@endforeach
@endif
@endsection
@section('content')
<main class="main">
        @if (Cart::instance('cart')->content()->count() > 0)
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
                                        <th scope="col">@lang('words.product-quantity')</th>
                                        <th scope="col">@lang('words.total-price')</th>
                                        <th scope="col">@lang('words.delete')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('cart')->content() as $cart)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset(firstImage($cart->model->images)) }}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{ route('Web.product.single', $cart->model->slug) }}">{{ $cart->name }}</a></h5>
                                            <p class="font-xs canseworksFontWeight">@foreach (json_decode($cart->options, true) as $key => $option) {{ "(".$key . ' : ' . $option.") "}} @endforeach</p>
                                        </td>
                                        <td class="price"><span >{{ priceToFormat($cart->price) }} ₺</span></td>
                                        <td class="text-center">
                                            <input type="number" class="col-lg-3 quantity-val" min="1" value="{{ $cart->qty }}" id="quantity-{{ $cart->rowId }}" data-id="{{ $cart->rowId }}">
                                        </td>
                                        <td class="price"><span id="price-{{ $cart->rowId }}">{{ priceToFormat($cart->price *  $cart->qty) }} ₺</span></td>
                                        <td class="action"><a href="{{ route('Web.Cart.delete', $cart->rowId) }}" class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                                <div class="border p-md-4 p-30 cart-totals">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Ara Toplam</td>
                                                    <td class="cart_total_amount subtotal"><span class="font-lg fw-900 text-brand">{{ replaceFormat(Cart::instance('cart')->subtotal()) }} ₺</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Vergi</td>
                                                    <td class="cart_total_amount tax"><span><i class="ti-gift mr-5"></i>%18 ( {{ replaceFormat(Cart::instance('cart')->tax()) }} ₺ )</span></td>
                                                </tr>
                                                @if (Session::get('coupon'))
                                                    <tr>
                                                        <td class="cart_total_label">Toplam</td>
                                                            <td class="cart_total_amount total">
                                                                <strong>
                                                                    <span class="fw-900 text-brand">
                                                                        <del>{{ replaceFormat(Cart::instance('cart')->total()) }} ₺</del>
                                                                    </span>
                                                                    <span class="font-xl fw-900 text-brand">
                                                                        {{ priceToFormat(replaceFormatTwo(Cart::instance('cart')->total()) - Session::get('coupon')) }} ₺
                                                                    </span>
                                                                    <span class="fw-900 text-brand">
                                                                        (@lang('words.discount') : {{ Session::get('coupon') }} ₺)
                                                                    </span>
                                                                </strong>
                                                            </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="cart_total_label">Toplam</td>
                                                        <td class="cart_total_amount total"><strong><span class="font-xl fw-900 text-brand">{{ replaceFormat(Cart::instance('cart')->total()) }} ₺</span></strong></td>
                                                    </tr>
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart-action text-end">
                                        @if (Session::get('coupon'))
                                        <input class="font-medium col-lg-2 cwFloatLeft" name="coupon" disabled placeholder="@lang('words.not-null-discount-code')">
                                        <button class="btn mb-sm-15 col-lg-2 cwCustomBtn" disabled>@lang('words.update')</button>
                                        @else
                                            <form action="{{ route('Web.Coupon.add') }}" method="POST">
                                                @csrf
                                                <input class="font-medium col-lg-2 cwFloatLeft" name="coupon" placeholder="@lang('words.discount-code')">
                                                <button type="submit" class="btn mr-10 mb-sm-15 col-lg-2 cwCustomBtn">@lang('words.update')</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('Web.Cart.destroy') }}" class="btn mb-sm-15 col-lg-2 cwFontSize12">@lang('words.clean')</a>
                                        <a href="" class="btn col-lg-2 cwFontSize12">@lang('words.complete-shopping')</a>
                                    </div>
                                </div>
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
                        <h4 class="mt-2">@lang('words.cart-empty')</h4>
                        <a href="{{ route('Web.main') }}" class="btn mr-10 mb-sm-15 mt-3 cwFontSize12">@lang('words.home')</a>
                        </div>
                    </center>
                </div>
            </div>
        </section>
        @endif
        
    </main>
@endsection