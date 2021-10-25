@extends('Back.main')
@section('title')
@lang('words.service-list')
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
                                <h4 class="card-title">@lang('words.service-list')</h4>
                                <a href="{{ route('Back.service.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.service-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="service_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.service-image')</th>
                                            <th>@lang('words.service-name')</th>
                                            <th>@lang('words.service-color')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                        <tr>
                                            <td></td>
                                            <td><img width="50" src="{{ asset($service->image) }}"></td>
                                            <td>{{ $service->title }}</td>
                                            <td>
                                                <div style="background-color: {{ $service->color }} !important;"
                                                    class="avatar">
                                                    <div class="avatar-content"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Service.update.get', $service->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Service.delete', $service->id) }}">@lang('words.delete')</a>
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