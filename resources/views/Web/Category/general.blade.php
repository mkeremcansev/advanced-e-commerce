@foreach (Cache::get('categorys') as $category)
    @if ($status == 1)
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
            </li>
        @endif
    @elseif($status == 2)
        @if (count($category->subCategories))
            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                    href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
                <ul class="dropdown">
                    @include('Web.Category.mobile', ['children'=>$category->subCategories])
                </ul>
            </li>
        @else
            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                    href="{{ route('Web.category.products', $category->slug) }}">{{ $category->title }}</a>
            </li>
        @endif
    @endif
@endforeach