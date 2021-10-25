@extends('Back.main')
@section('title')
@lang('words.category-list')
@endsection
@section('script')
@if ($message = Session::get('success'))
<script>
    toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
</script>
@elseif($message = Session::get('error'))
<script>
    toastr.error('', "{{ $message }}", { positionClass: "toast-bottom-right" })
</script>
@endif
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="responsive-datatable">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">@lang('words.category-list')</h4>
                                <a href="{{ route('Back.category.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.category-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="category_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.category-image')</th>
                                            <th>@lang('words.category-name')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subs as $sub)
                                        <tr>
                                            <td></td>
                                            <td><img width="50" src="{{ asset($sub->image) }}" alt=""></td>
                                            <td>{{ App\Models\Category::getParentsTree($sub, $sub->title) }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Category.update.get', $sub->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Category.delete', $sub->id) }}">@lang('words.delete')</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('words.category-tree')</h4>
                                </div>
                                <div class="card-body">
                                    <div id="jstree-basic">
                                        <ul>
                                            @foreach ($categorys as $category)
                                                
                                            
                                            <li data-jstree='{"icon" : "fa fa-plus"}'>
                                                {{ $category->title }}
                                                <ul>
                                                    @if (count($category->children))
                                                            @include('Back.Category.category', ['children'=>$category->children])
                                                    @endif
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection