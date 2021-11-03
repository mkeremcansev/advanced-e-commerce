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

                                    {{-- @foreach (Cache::get('categorys') as $category)
                                        @if (count($category->subCategories))
                                        <li>
                                            <ul class="dropdown-c">
                                                <li>
                                                    <a class="cwCategoryFontSize85" href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
                                                    <ul>
                                                        @include('Web.Category.category', ['children'=>$category->subCategories])
                                                    </ul>
                                                </li>
                                            </ul>
                                            @else
                                            <ul class="dropdown-c">
                                                <li>
                                                    <a class="cwCategoryFontSize85" href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach --}}
                                    {{-- @include('Web.Category.general', ['status'=>1]) --}}
                                    {!! Cache::get('dCategories') !!}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                @if (Auth::check() && Auth::user()->status == false)
                                    <a href="{{ route('Web.Account') }}">
                                        <i class="fi-rs-user"></i>
                                    </a>
                                @elseif(Auth::check() && Auth::user()->status == true)
                                    <a href="{{ route('Panel.main') }}">
                                        <i class="fi-rs-user"></i>
                                    </a>
                                @else
                                    <a href="{{ route('Web.login-register') }}">
                                        <i class="fi-rs-user"></i>
                                    </a>
                                @endif
                                
                            </div>
                            <div id="cwCompare" class="header-action-icon-2">
                                <a href="{{ route('Web.compare') }}">
                                    <i class="fi-rs-copy"></i>
                                    <span class="pro-count white">{{ Cart::instance('compare')->content()->count() }}</span>
                                </a>
                            </div>
                            <div id="cwWishlist" class="header-action-icon-2">
                                <a href="{{ route('Web.wishlist') }}">
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