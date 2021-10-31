@extends('Panel.main')
@section('title')
Ana Sayfa
@endsection
@section('script')
    @if ($message = Session::get('success'))
        <script>
            toastr.success('', '{{ $message }}', { positionClass: "toast-bottom-right" })
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
            <section>
                <div class="row match-height">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="{{ asset('Panel/app-assets/images/elements/decore-left.png') }}"
                                    class="congratulations-img-left" />
                                <img src="{{ asset('Panel/app-assets/images/elements/decore-right.png') }}"
                                    class="congratulations-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">@lang('words.hello-user', ['name'=>Auth::user()->name])</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-primary mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{ $products->count() }}</h4>
                                                <p class="card-text font-small-3 mb-0">@lang('words.total-product')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="media">
                                            <div class="avatar bg-light-info mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="layers" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{ $_categorys->count() }}</h4>
                                                <p class="card-text font-small-3 mb-0">@lang('words.total-category')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="media">
                                            <div class="avatar bg-light-danger mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="user" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{ $users->count() }}</h4>
                                                <p class="card-text font-small-3 mb-0">@lang('words.total-user')</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="media">
                                            <div class="avatar bg-light-success mr-2">
                                                <div class="avatar-content">
                                                    <i data-feather="refresh-cw" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="media-body my-auto">
                                                <h4 class="font-weight-bolder mb-0">{{ $reviews->count() }}</h4>
                                                <p class="card-text font-small-3 mb-0">@lang('words.total-review')</p>
                                            </div>
                                        </div>
                                    </div>
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