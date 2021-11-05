@extends('Panel.main')
@section('title')
@lang('words.coupon-list')
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">@lang('words.coupon-list')</h4>
                                <a href="{{ route('Panel.Coupon.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.coupon-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="service_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.coupon-code')</th>
                                            <th>@lang('words.coupon-discount')</th>
                                            <th>@lang('words.status')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                        <tr>
                                            <td></td>
                                            <td>{{ $coupon->coupon }}</td>
                                            <td>{{ $coupon->discount }}</td>
                                            <td>
                                                @if ($coupon->status == 1)
                                                    <span class="cw-green-color-1">@lang('words.active')</span>
                                                @elseif($coupon->status == 0)
                                                    <span class="cw-red-color-1">@lang('words.passive')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Panel.Coupon.update.get', $coupon->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Panel.Coupon.delete', $coupon->id) }}">@lang('words.delete')</a>
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