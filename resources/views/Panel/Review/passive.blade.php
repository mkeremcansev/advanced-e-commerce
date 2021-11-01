@extends('Panel.main')
@section('title')
@lang('words.passive-review-list')
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
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">@lang('words.passive-review-list')</h4>
                                <a href="{{ route('Panel.Active.reviews') }}" class="btn btn-info waves-effect waves-float waves-light">@lang('words.active-review-list')</a>
                            </div>
                            <div class="card-datatable">
                                <table id="service_list_table" class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('words.review-title')</th>
                                            <th>@lang('words.user')</th>
                                            <th>@lang('words.product')</th>
                                            <th>@lang('words.rating')</th>
                                            <th>@lang('words.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews_ as $review)
                                        <tr>
                                            <td></td>
                                            <td>{{ $review->title }}</td>
                                            <td>{{ $review->getReviewUser->name }}</td>
                                            <td><a target="_blank" href="{{ route('Web.product.single', $review->getReviewProduct->slug) }}">{{ $review->getReviewProduct->title }}</a></td>
                                            <td>
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
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('words.actions')</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item text-success" href="{{ route('Panel.Status.review', $review->id) }}">@lang('words.active')</a>
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