@extends('Web.main')
@section('title')
{{ setting('title') }}
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
    });
    $('.add-compare-cw').on('click', function(){
        let product = $(this).attr('compare-hash');
        let btnId = $('.add-compare-cw');
        btnId.addClass('cwDisabled');
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
    @include('Web.Layouts.main-service')
    @include('Web.Layouts.main-popular')
    @include('Web.Layouts.main-campaign')
    @include('Web.Layouts.main-random-category')
</main>
@endsection