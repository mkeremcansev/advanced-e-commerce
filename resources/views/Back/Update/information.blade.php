@extends('Back.main')
@section('title')
{{ $product->title }} ( {{ $product->getCategory->title }} )
@endsection
@section('script')
    @if ($message = Session::get('success'))
    <script>
        toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
    </script>
    @endif

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <script>
        toastr.options = {
            "preventDuplicates": true
        }
        toastr.error('', "{{ $error }}", { positionClass: "toast-bottom-right" })
        </script>
    @endforeach
@endif

@if ($message = Session::get('error'))
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
            <section class="form-control-repeater">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body">
                                @lang('words.information-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                               
                                    <h4 class="card-title"><a href="{{ route('Product.update.get', $product->id) }}">{{ $product->title }}<i data-feather="arrow-right"></i></a>
                                
                                    @if ($product->status == "1")
                                        <span style="color: #28C76F;"> @lang('words.active')</span>
                                    @else
                                        <span style="color: #EA5455;"> @lang('words.passive')</span>
                                    @endif
                                </h4>
                                <a href="{{ route('Variant.add.get', $product->id) }}" class="btn btn-success waves-effect waves-float waves-light">@lang('words.variation')</a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('Information.add') }}" class="invoice-repeater" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <div class="row">
                                        <div class="col-12 mt-1 mb-1">
                                            <button class="btn btn-success btn-primary" type="button" data-repeater-create>
                                                <i data-feather="plus" class="mr-25"></i>
                                                <span>@lang('words.add')</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div data-repeater-list="information">
                                        <div data-repeater-item>
                                            <div class="row d-flex align-items-end">
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="">@lang('words.information-title')</label>
                                                        <input type="text" class="form-control" name="title"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label for="">@lang('words.information-description')</label>
                                                        <input type="text" class="form-control" name="description"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="form-group variant-form-group">
                                                        <button class="btn btn-danger text-nowrap variant-btn-canseworks"
                                                            data-repeater-delete type="button">
                                                            <i data-feather="x" class="mr-25"></i>
                                                            <span>@lang('words.delete')</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light mb-1 mt-1 float-right">@lang('words.save')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">@lang('words.product-information-list')</h4>
                        </div>
                        <div class="card-datatable">
                            <table id="service_list_table" class="dt-responsive table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('words.information-title')</th>
                                        <th>@lang('words.information-description')</th>
                                        <th>@lang('words.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->getInformation as $information)
                                    <tr>
                                        <td></td>
                                        <td>{{ $information->title }}</td>
                                        <td>{{ $information->description }}</td>
                                        <td><a href="{{ route('Information.delete', $information->id) }}" class="btn btn-danger waves-effect waves-float waves-light">@lang('words.delete')</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection