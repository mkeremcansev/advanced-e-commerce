<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="{{ asset('Web/assets/imgs/theme/icons/icon-email.svg') }}"
                                alt="">
                            <h4 class="font-size-20 mb-0 ml-3">E-Bülten'e kayıt olun!</h4>
                        </div>
                        <div class="col my-4 my-md-0 des">
                            <h5 class="font-size-15 ml-4 mb-0">İndirimlerden haberdar olun!</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form class="form-subcriber d-flex wow fadeIn animated">
                        <input type="email" class="form-control bg-white font-small" placeholder="@lang('words.email')">
                        <button class="btn bg-dark text-white col-lg-3" type="submit">Kayıt Ol</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">@lang('words.popular-products')</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        @foreach ($_products->sortByDesc('hit')->take(5) as $product) 
                        <li><a href="{{ route('Web.product.single', $product->slug) }}">{{ $product->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">@lang('words.new-products')</h5>
                    <ul class="footer-list wow fadeIn animated">
                        @foreach ($_products->sortByDesc('id')->take(5) as $product)
                        <li><a href="{{ route('Web.product.single', $product->slug) }}">{{ $product->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">@lang('words.contracts')</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{ route('Web.Contract.account-contracts') }}">@lang('words.account-contracts')</a></li>
                        <li><a href="{{ route('Web.Contract.return-conditions') }}">@lang('words.return-conditions')</a></li>
                        <li><a href="{{ route('Web.Contract.distance-sales-agreement') }}">@lang('words.distance-sales-agreement')</a></li>
                        <li><a href="{{ route('Web.Contract.illumination-and-consent-text') }}">@lang('words.illumination-and-consent-text')</a></li>
                        <li><a href="{{ route('Web.Contract.privacy-policy') }}">@lang('words.privacy-policy')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-12 text-center">
                <p class="float-md-left font-sm text-muted mb-0">
                    <strong class="text-brand">{{ setting('footer') }}</strong>
                </p>
            </div>
        </div>
    </div>
</footer>
{{-- <script src="{{ asset('Web/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script> --}}
<script src="{{ asset('Web/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('Web/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery-ui.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('Web/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('Web/assets/js/main.js') }}"></script>
<script src="{{ asset('Web/assets/js/shop.js') }}"></script>
<script src="{{ asset('Web/assets/js/canseworks.js') }}"></script>
<script src="{{ asset('Web/assets/js/iziToast.min.js') }}"></script>
@yield('script')
</body>

</html>