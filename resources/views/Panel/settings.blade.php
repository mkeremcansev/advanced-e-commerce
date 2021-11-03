@extends('Panel.main')
@section('title')
@lang('words.general-settings')
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
<script>
    $(document).ready(function () {
    $('#service_color').spectrum({
        type: "component"
    });
});
</script>
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
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-success" role="alert">
                            <div class="alert-body">
                                @lang('words.setting-alert')
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('words.general-settings')</h4>
                            </div>
                            <form id="setting_form" method="POST" action="{{ route('Panel.Setting.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">@lang('words.website-title')</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ setting('title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">@lang('words.website-description')</label>
                                        <textarea type="text" class="form-control"
                                            name="description">{{ setting('description') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="keywords">@lang('words.website-keywords')</label>
                                        <div class="badge badge-light-success">@lang('words.setting-keywords-alert')
                                        </div>
                                        <textarea type="text" class="form-control"
                                            name="keywords">{{ setting('keywords') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="footer">@lang('words.website-footer')</label>
                                        <input type="text" class="form-control" name="footer"
                                            value="{{ setting('footer') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="adress">@lang('words.website-adress')</label>
                                        <textarea type="text" class="form-control"
                                            name="adress">{{ setting('adress') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="map">@lang('words.website-map')</label>
                                        <textarea type="text" class="form-control"
                                            name="map">{{ setting('map') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="facebook">@lang('words.website-facebook')</label>
                                        <input type="text" class="form-control" name="facebook"
                                            value="{{ setting('facebook') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="instagram">@lang('words.website-instagram')</label>
                                        <input type="text" class="form-control" name="instagram"
                                            value="{{ setting('instagram') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter">@lang('words.website-twitter')</label>
                                        <input type="text" class="form-control" name="twitter"
                                            value="{{ setting('twitter') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="mail">@lang('words.website-mail')</label>
                                        <input type="text" class="form-control" name="mail"
                                            value="{{ setting('mail') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp">@lang('words.website-whatsapp')</label>
                                        <input type="text" class="form-control" name="whatsapp"
                                            value="{{ setting('whatsapp') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">@lang('words.website-phone')</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ setting('phone') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="logo">@lang('words.website-logo')</label>
                                        <input type="file" class="form-control" name="logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="favicon">@lang('words.website-favicon')</label>
                                        <input type="file" class="form-control" name="favicon">
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-float waves-light mt-2 mb-2 float-right">@lang('words.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-6">
                                        <h4 class="card-title">Güncel Logo</h4>
                                        <a href="javascript:void(0)">
                                            <img width="150" src="{{ asset(setting('logo')) }}"
                                                class="img-fluid rounded mb-1" />
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <h4 class="card-title">Güncel Favicon</h4>
                                        <a href="javascript:void(0)">
                                            <img width="20" src="{{ asset(setting('favicon')) }}"
                                                class="img-fluid rounded mb-1" />
                                        </a>
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