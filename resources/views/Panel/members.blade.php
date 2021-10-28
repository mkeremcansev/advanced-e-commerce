@extends('Panel.main')
@section('title')
@lang('words.member-list')
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
                                <h4 class="card-title">@lang('words.member-list')</h4>
                            </div>
                            <div class="card-datatable">
                                <table id="brand_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.name-surname')</th>
                                            <th>@lang('words.phone')</th>
                                            <th>@lang('words.email')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                        <tr>
                                            <td></td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->phone }}</td>
                                            <td>{{ $member->email }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-warning" href="{{ route('Panel.member-to-admin.update', $member->id) }}">@lang('words.admin')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Panel.banned', $member->id) }}">@lang('words.banned')</a>
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