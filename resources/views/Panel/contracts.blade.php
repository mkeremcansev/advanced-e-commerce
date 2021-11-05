@extends('Panel.main')
@section('title')
@lang('words.contracts')
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
                                <h4 class="card-title">@lang('words.contracts')</h4>
                            </div>
                            <form id="setting_form" method="POST" action="{{ route('Panel.Contract.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="description">@lang('words.privacy-policy')</label>
                                        <textarea type="text" class="form-control ckeditor" name="privacy_policy">{{ setting('privacy_policy') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('words.account-contracts')</label>
                                        <textarea type="text" class="form-control ckeditor" name="account_contracts">{{ setting('account_contracts') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('words.distance-sales-agreement')</label>
                                        <textarea type="text" class="form-control ckeditor" name="distance_sales_agreement">{{ setting('distance_sales_agreement') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('words.illumination-and-consent-text')</label>
                                        <textarea type="text" class="form-control ckeditor" name="illumination_and_consent_text">{{ setting('illumination_and_consent_text') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">@lang('words.return-conditions')</label>
                                        <textarea type="text" class="form-control ckeditor" name="return_conditions">{{ setting('return_conditions') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light mt-2 mb-2 float-right">@lang('words.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection