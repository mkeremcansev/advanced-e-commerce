<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="{{ asset('Web') }}/assets/imgs/theme/icons/icon-email.svg"
                                alt="">
                            <h4 class="font-size-20 mb-0 ml-3">E-Bülten'e kayıt olun!</h4>
                        </div>
                        <div class="col my-4 my-md-0 des">
                            <h5 class="font-size-15 ml-4 mb-0">İndirimlerden haberdar olun!</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="form-subcriber d-flex wow fadeIn animated">
                        <input type="email" class="form-control bg-white font-small" placeholder="@lang('words.email')">
                        <button class="btn bg-dark text-white col-lg-3" type="submit">Kayıt Ol</button>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="index.html"><img src="{{ asset($settings->logo) }}" alt="logo"></a>
                        </div>
                        <p class="wow fadeIn animated mt-2">
                            <strong>@lang('words.adress') : </strong>{{ $settings->adress }}
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>@lang('words.phone') : </strong>{{ $settings->phone }}
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>@lang('words.email') : </strong>{{ $settings->mail }}
                        </p><br>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="{{ $settings->facebook }}"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-facebook.svg') }}" alt="{{ $settings->facebook }}"></a>
                            <a href="{{ $settings->twitter }}"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                            <a href="{{ $settings->instagram }}"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">...........</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">...........</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="widget-title wow fadeIn animated">...........</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated">...........</p>
                            <div class="download-app wow fadeIn animated">
                                <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                        src="{{ asset('Web') }}/assets/imgs/theme/app-store.jpg" alt=""></a>
                                <a href="#" class="hover-up"><img
                                        src="{{ asset('Web') }}/assets/imgs/theme/google-play.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated">...........</p>
                            <img class="wow fadeIn animated"
                                src="{{ asset('Web') }}/assets/imgs/theme/payment-method.png" alt="">
                        </div>
                    </div>
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
                    <strong class="text-brand">{{ $settings->footer }}</strong>
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