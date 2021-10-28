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
                        @foreach ($categorys as $category)
                        @if (count($category->children))
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
                            <ul class="dropdown">
                                @include('Web.Category.mobile', ['children'=>$category->children])
                            </ul>
                        </li>
                        @else
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
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