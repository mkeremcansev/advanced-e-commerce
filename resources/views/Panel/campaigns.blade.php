@extends('Panel.main')
@section('title')
@lang('words.campaign-list')
@endsection
@section('script')
@if ($message = Session::get('success'))
<script>
    toastr.success('', "{{ $message }}", {positionClass: "toast-bottom-right"})
</script>
@endif
@if ($message = Session::get('error'))
<script>
    toastr.error('', "{{ $message }}", {positionClass: "toast-bottom-right"})
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
                                <h4 class="card-title">@lang('words.campaign-list')</h4>
                                <a href="{{ route('Panel.campaign.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.campaign-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="brand_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.campaign-image')</th>
                                            <th>@lang('words.campaign-title')</th>
                                            <th>@lang('words.campaign-product-count')</th>
                                            <th>@lang('words.status')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campaigns as $campaign)
                                        <tr>
                                            <td></td>
                                            <td><img width="50" src="{{ asset($campaign->image) }}"></td>
                                            <td>{{ $campaign->title }}</td>
                                            <td><span class="text-primary font-weight-bold">{{ $campaign->getCampaignValue->count() }}</span> </td>
                                            <td>
                                                @if ($campaign->status == 1)
                                                    <span class="text-success font-weight-bold">@lang('words.active')</span> </td>
                                                @else
                                                    <span class="text-danger font-weight-bold">@lang('words.passive')</span> </td>
                                                @endif
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Panel.Campaign.update.get', $campaign->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-primary" href="{{ route('Panel.Campaign.add.get', $campaign->id) }}">@lang('words.product')</a>
                                                        @if ($campaign->status == 0)
                                                            <a class="dropdown-item text-success" href="{{ route('Panel.Campaign.status', ['id'=>$campaign->id, 'status'=>1]) }}">@lang('words.active')</a>
                                                        @else
                                                            <a class="dropdown-item text-warning" href="{{ route('Panel.Campaign.status', ['id'=>$campaign->id, 'status'=>0]) }}">@lang('words.passive')</a>
                                                        @endif
                                                        <a class="dropdown-item text-danger" href="{{ route('Panel.Campaign.delete', $campaign->id) }}">@lang('words.delete')</a>
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
                </div>
            </section>
        </div>
    </div>
</div>
@endsection