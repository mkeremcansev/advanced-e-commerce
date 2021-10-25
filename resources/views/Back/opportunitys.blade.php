@extends('Back.main')
@section('title')
Fırsat listesi
@endsection
@section('script')
@if ($message = Session::get('success'))
<script>
    toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
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
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">@lang('words.opportunity-list')</h4>
                                <a href="{{ route('Back.opportunity.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.opportunity-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="service_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.opportunity-image')</th>
                                            <th>@lang('words.opportunity-title')</th>
                                            <th>@lang('words.opportunity-product')</th>
                                            <th>@lang('words.opportunity-end-date-label')</th>
                                            <th>@lang('words.status')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($opportunitys as $opportunity)
                                        <tr>
                                            <td></td>
                                            <td><img width="50" src="{{ asset($opportunity->image) }}"></td>
                                            <td>{{ $opportunity->title }}</td>
                                            <td>{{ $opportunity->getOpportunityProduct->title }}</td>
                                            <td><span class="font-weight-bold">{{ \Carbon\Carbon::parse($opportunity->end)->diffForHumans() }}</span></td>
                                            <td>
                                                @if ($opportunity->status == 0)
                                                    <span class="text-danger font-weight-bold">@lang('words.opportunity-time-expired')</span>
                                                @else
                                                    <span class="text-success font-weight-bold">@lang('words.opportunity-resume-again')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Opportunity.update.get', $opportunity->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Opportunity.delete', $opportunity->id) }}">@lang('words.delete')</a>
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