    @foreach ($children as $category)
            @if (count($category->subCategories))
                <li data-jstree='{"icon" : "fa fa-plus"}'>
                    {{ $category->title }}
                    <ul>
                        @include('Panel.Category.category', ['children'=>$category->subCategories])
                    </ul>
                </li>
            @else
            <li data-jstree='{"icon" : "fa fa-plus"}'>{{ $category->title }}</li>
            @endif
    @endforeach