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
                </div>
            </section>
        </div>
    </div>
</div>
@endsection