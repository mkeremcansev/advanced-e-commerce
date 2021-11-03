@foreach ($children as $item)
    @if (count($item->subCategories))
        <li class="menu-item-has-children"><span class="menu-expand"></span>
            <a href="{{ route('Web.category.products', $item->slug) }}">{{ $item->title }}</a>
            <ul class="dropdown">
                @include('Web.Category.mobile', ['children'=>$item->subCategories])
            </ul>
        </li>
    @else
    <li><a href="{{ route('Web.category.products', $item->slug) }}">{{ $item->title }}</a></li>
    @endif
@endforeach