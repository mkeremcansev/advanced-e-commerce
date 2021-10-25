    @foreach ($children as $category)
            @if (count($category->children))
                <li data-jstree='{"icon" : "fa fa-plus"}'>
                    {{ $category->title }}
                    <ul>
                        @include('Back.Category.category', ['children'=>$category->children])
                    </ul>
                </li>
            @else
            <li data-jstree='{"icon" : "fa fa-plus"}'>{{ $category->title }}</li>
            @endif
    @endforeach