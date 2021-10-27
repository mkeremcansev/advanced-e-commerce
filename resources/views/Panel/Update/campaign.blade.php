@extends('Panel.main')
@section('title')
{{ $campaign->title }}
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
                                @lang('words.campaign-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                    <h4 class="card-title"><a href="{{ route('Panel.Campaign.update.get', $campaign->id) }}">{{ $campaign->title }}<i data-feather="arrow-right"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('Panel.Campaign.value.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $campaign->id }}" name="campaign_id">
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="a">@lang('words.campaign-product-select')</label>
                                                        <select class="select2 form-control" name="products[]" multiple>
                                                            @foreach ($_products as $product)
                                                                <option value="{{$product->id}}" @if($campaign->getCampaignValue->contains('product_id',$product->id)) disabled @endif>{{$product->title}}</option>
                                                            @endforeach
                                                        </select>
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
                            <h4 class="card-title">@lang('words.campaign-product-list')</h4>
                        </div>
                        <div class="card-datatable">
                            <table id="service_list_table" class="dt-responsive table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>@lang('words.product')</th>
                                        <th>@lang('words.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campaign->getCampaignValue as $value)
                                    <tr>
                                        <td></td>
                                        <td>{{ $value->getCampaignValueProduct->title }} </td>
                                        <td><a href="{{ route('Panel.Campaign.value.delete', $value->id) }}" class="btn btn-danger waves-effect waves-float waves-light">@lang('words.delete')</a></td>
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