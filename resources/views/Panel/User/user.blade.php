@extends('Panel.main')
@section('title')
{{ $user->name }}
@endsection
@section('script')
    @if ($message = Session::get('success'))
    <script>
        toastr.success('', "{{ $message }}", { positionClass: "toast-bottom-right" })
    </script>
    @elseif($message = Session::get('error'))
    <script>
        toastr.error('', "{{ $message }}", { positionClass: "toast-bottom-right" })
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
            <section id="page-account-settings">
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column nav-left">
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">{{ $user->name }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                        <i data-feather="refresh-cw" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">@lang('words.user-reviews')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-pill-info" data-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                        <i data-feather="shopping-cart" class="font-medium-3 mr-1"></i>
                                        <span class="font-weight-bold">@lang('words.orders')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <form class="validate-form">
                                                <div class="row mt-1">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.name-surname')</label>
                                                            <input type="text" class="form-control" value="{{ $user->name }}" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.phone-number')</label>
                                                            <input type="text" class="form-control" value="{{ $user->phone }}" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.email-adress')</label>
                                                            <input type="text" class="form-control" value="{{ $user->email }}" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.coming-time')</label>
                                                            <input type="text" class="form-control" value="{{ $user->created_at->diffForHumans() }} ({{ $user->created_at }})" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.account-verification')</label>
                                                            <input type="text" 
                                                            @if($user->verify == 0 && $user->send == 0) class="form-control cw-red-color-1 cw-fwb-1" value="@lang('words.not-verify')"
                                                            @elseif($user->verify == 1) class="form-control cw-green-color-1 cw-fwb-1" value="@lang('words.yes-verify')"
                                                            @elseif($user->verify == 0 && $user->send == 1)class="form-control cw-rating-color cw-fwb-1" value="@lang('words.verify-email-messagge-send')"
                                                            @endif readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group">
                                                            <label for="account-twitter">@lang('words.user-status')</label>
                                                            <input type="text" 
                                                            @if($user->status == 0 || $user->status == 1) class="form-control cw-green-color-1 cw-fwb-1" value="@lang('words.active')"
                                                            @elseif($user->status == 2) class="form-control cw-red-color-1 cw-fwb-1" value="@lang('words.banned-user')"
                                                            @endif readonly
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        @if ($user->status == 0)
                                                            <a href="{{ route('Panel.member-to-admin.update', $user->id) }}" class="btn btn-success waves-effect waves-float waves-light mt-2 mb-2 float-left">
                                                                @lang('words.admin')
                                                            </a>
                                                        @elseif($user->status == 1)
                                                            <a href="{{ route('Panel.admin-to-member.update', $user->id) }}" class="btn btn-warning waves-effect waves-float waves-light mt-2 mb-2 float-left">
                                                                @lang('words.member')
                                                            </a>
                                                        @endif
                                                        @if ($user->status == 0 || $user->status == 1)
                                                            <a href="{{ route('Panel.banned', $user->id) }}" class="btn btn-danger waves-effect waves-float waves-light mt-2 mb-2 ml-2 float-left">
                                                                @lang('words.banned')
                                                            </a>
                                                        @else
                                                            <a href="{{ route('Panel.unbanned', $user->id) }}" class="btn btn-success waves-effect waves-float waves-light mt-2 mb-2 ml-2 float-left">
                                                                @lang('words.unbanned')
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                            @if ($user->getUserReviews->count() > 0)
                                                <form class="validate-form">
                                                <div class="row">
                                                    @foreach ($user->getUserReviews as $review)
                                                    <div class="col-12 col-sm-4">
                                                        <div class="card text-center">
                                                            <div class="card-body">
                                                                <h4 class="card-title">
                                                                    @if ($review->rating == 1)
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                    @elseif($review->rating == 2)
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                    @elseif($review->rating == 3)
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                    @elseif($review->rating == 4)
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i data-feather="star"></i>
                                                                    @elseif($review->rating == 5)
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                        <i class="cw-rating-color" data-feather="star"></i>
                                                                    @endif
                                                                </h4>
                                                                <p class="card-text">{{ maxCaharacter($review->title, 50) }}</p>
                                                                <p class="card-text">
                                                                    <small>
                                                                        <a data-toggle="tooltip" data-placement="bottom" title="{{ $review->getReviewProduct->title }}" target="_blank" href="{{ route('Web.product.single', $review->getReviewProduct->slug) }}">
                                                                            {{ maxCaharacter($review->getReviewProduct->title, 40) }}
                                                                        </a>
                                                                    </small>
                                                                </p>
                                                                @if ($review->status == 0)
                                                                    <a class="btn btn-success waves-effect waves-float waves-light mt-2 mb-2" href="{{ route('Panel.Status.review', $review->id) }}">@lang('words.active')</a>
                                                                @else
                                                                    <a class="btn btn-danger waves-effect waves-float waves-light mt-2 mb-2" href="{{ route('Panel.Status.review', $review->id) }}">@lang('words.passive')</a>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </form>
                                            @else
                                                <h1 class="text-center">@lang('words.user-not-review')</h1>
                                            @endif
                                            
                                        </div>
                                        <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
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