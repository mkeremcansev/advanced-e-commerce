<!DOCTYPE html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('favicon')) }}">
    <link rel="stylesheet" href="{{ asset('Web/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('Web/assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @include('Web.Layouts.root-color')
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
                                        href="tel://{{ setting('phone') }}">{{ setting('phone') }}</a>
                                </li>
                                <li><i class="fi-rs-marker"></i>{{ setting('adress') }}</li>
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
                        <a href="{{ route('Web.main') }}"><img src="{{ asset(setting('logo')) }}" alt="{{ setting('title') }}"></a>
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
                                    <a class="mini-cart-icon">
                                        <i class="fi-rs-user"></i>
                                    </a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 profile-dropdown-canseworks">
                                        <ul>
                                            @if (Auth::check() && Auth::user()->status == 0)
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Web.Account') }}">@lang('words.my-account')</a>
                                                </li>
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Web.Logout.add') }}">@lang('words.logout')</a>
                                                </li>
                                            @elseif(Auth::check() && Auth::user()->status == 1)
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Panel.main') }}">@lang('words.admin-panel')</a>
                                                </li>
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Panel.logout') }}">@lang('words.logout')</a>
                                                </li>
                                            @elseif(Auth::check() && Auth::user()->status == 2)
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Panel.main') }}">@lang('words.homepage') (@lang('words.banned-user'))</a>
                                                </li>
                                                <li>
                                                    <a class="canseworksFontWeight" href="{{ route('Panel.logout') }}">@lang('words.logout')</a>
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
        @include('Web.Layouts.desktop-header')
    </header>
@include('Web.Layouts.mobile-header')