@extends('Panel.main')
@section('title')
@lang('words.announcement-list')
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
                                <h4 class="card-title">@lang('words.announcement-list')</h4>
                                <a href="{{ route('Panel.announcement.add') }}"
                                    class="btn btn-info waves-effect waves-float waves-light">@lang('words.announcement-add')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="announcement_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.announcement-title')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($announcements as $announcement)
                                        <tr>
                                            <td></td>
                                            <td>{{ $announcement->title }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Panel.Announcement.update.get', $announcement->id) }}">@lang('words.edit')</a>
                                                        <a class="dropdown-item text-danger" href="{{ route('Panel.Announcement.delete', $announcement->id) }}">@lang('words.delete')</a>
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