<!DOCTYPE html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($settings->favicon) }}">
    <link rel="stylesheet" href="{{ asset('Web/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('Web/assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --main--project--color: #0077ff;
            --product--btn--border--color : #0077ff;
            --product--btn--bg--color : #52a3ff;
        }
    </style>
</head>

<body> <!-- oncontextmenu="return false" ondragstart="return false" onselectstart="return false" -->
    <header class="header-area header-style-3 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="rengarenk">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><i class="fi-rs-smartphone"></i> <a
                                        href="tel://{{ $settings->phone }}">{{ $settings->phone }}</a>
                                </li>
                                <li><i class="fi-rs-marker"></i>{{ $settings->adress }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    @foreach ($announcements as $announcement)
                                    <li>{{ $announcement->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Hakkımızda</li>
                                <li>İletişim</li>
                                <li>SSS</li>
                                <li>Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('Web.main') }}"><img src="{{ asset($settings->logo) }}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <input type="text" placeholder="12 Ürün içerisinde arama yapın...">
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="">
                                        <i class="fi-rs-user"></i>
                                    </a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 profile-dropdown-canseworks">
                                        <ul>
                                            @if (Auth::user())
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Web.account') }}">@lang('words.my-account')</a>
                                                </li>
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Web.Logout.add') }}">@lang('words.logout')</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Web.login-register') }}">@lang('words.login') - @lang('words.register')</a>
                                                </li>
                                            @endif
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div id="cwCompare" class="header-action-icon-2">
                                    <a href="{{ route('Web.compare') }}">
                                        <i class="fi-rs-copy"></i>
                                        <span class="pro-count blue">{{ Cart::instance('compare')->content()->count() }}</span>
                                    </a>
                                </div>
                                <div id="cwWishlist" class="header-action-icon-2">
                                    <a href="{{ route('Web.wishlist') }}">
                                        <i class="fi-rs-heart"></i>
                                        <span class="pro-count blue">{{ Cart::instance('wishlist')->content()->count() }}</span>
                                    </a>
                                </div>
                                <div id="cwCart" class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('Web.cart') }}">
                                        <i class="fi-rs-shopping-cart"></i>
                                        <span class="pro-count blue">{{ Cart::instance('cart')->content()->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar fancy-border">
            <div class="container">
                <div class="header-wrap header-space-between position-relative  main-nav">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('Web.main') }}"><img src="{{ asset($settings->logo) }}" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block zIndexCanseworks">
                            <nav>
                                <ul>
                                    @foreach ($categorys as $item)
                                    @if (count($item->children))
                                    <li>
                                        <ul class="dropdown-c">
                                            <li>
                                                <a class="cwCategoryFontSize85" href="{{ $item->slug }}">{{ $item->title }}</a>
                                                <ul>
                                                    @include('Web.Category.category', ['children'=>$item->children])
                                                </ul>
                                            </li>
                                        </ul>
                                        @else
                                        <ul class="dropdown-c">
                                            <li>
                                                <a class="cwCategoryFontSize85" href="{{ $item->slug }}">{{ $item->title }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('Web.login-register') }}">
                                    <i class="fi-rs-user"></i>
                                </a>
                            </div>
                            <div id="cwCompare" class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <i class="fi-rs-copy"></i>
                                    <span class="pro-count white">{{ Cart::instance('wishlist')->content()->count() }}</span>
                                </a>
                            </div>
                            <div id="cwWishlist" class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <i class="fi-rs-heart"></i>
                                    <span class="pro-count white">{{ Cart::instance('wishlist')->content()->count() }}</span>
                                </a>
                            </div>
                            <div id="cwCart" class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('Web.cart') }}">
                                    <i class="fi-rs-shopping-cart"></i>
                                    <span class="pro-count white">{{ Cart::instance('cart')->content()->count() }}</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('Web.main') }}"><img src="{{ asset($settings->logo) }}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="12 Ürün içerisinde arama yapın...">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <nav>
                        <ul class="mobile-menu">
                            @foreach ($categorys as $item)
                            @if (count($item->children))
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{ $item->slug }}">{{ $item->title }}</a>
                                <ul class="dropdown">
                                    @include('Web.Category.mobile', ['children'=>$item->children])
                                </ul>
                            </li>
                            @else
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{ $item->slug }}">{{ $item->title }}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="page-contact.html"> Yozgat </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login-register.html">@lang('words.login') - @lang('words.register') </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="tel://05467407599">+90 (546) 740 75 99 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">@lang('words.follow-us')</h5>
                    <a href="#"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('Web/assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>