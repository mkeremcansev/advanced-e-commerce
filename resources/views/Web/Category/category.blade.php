@foreach ($children as $item)
        @if (count($item->subCategories))
            <li>
                <a href="{{ route('Web.category.products', $item->slug) }}">{{ $item->title }} <i class="fi-rs-angle-right"></i></a>
                <ul class="level-menu level-menu-modify">
                    @include('Web.Category.category', ['children'=>$item->subCategories])
                </ul>
            </li>
        @else
            <li><a href="{{ route('Web.category.products', $item->slug) }}">{{ $item->title }}</a></li>
        @endif
@endforeach