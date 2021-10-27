    @foreach ($children as $item)
            @if (count($item->children))
                <li>
                    <a href="{{ $item->slug }}">{{ $item->title }} <i class="fi-rs-angle-right"></i></a>
                    <ul class="level-menu level-menu-modify">
                        @include('Web.Category.category', ['children'=>$item->children])
                    </ul>
                </li>
            @else
                <li><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
            @endif
    @endforeach