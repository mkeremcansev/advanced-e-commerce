@extends('Web.main')
@section('title')
{{ setting('title') }} | @lang('words.illumination-and-consent-text')
@endsection
@section('content')
<main class="main">
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">@lang('words.illumination-and-consent-text')</h3>
                                    </div>
                                        {!! setting('illumination_and_consent_text') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
@endsection