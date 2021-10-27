@extends('Web.main')
@section('title')
{{ $settings->title }} - @lang('words.my-account')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#account-update').on('click', function () {
                let password = $('#password').val();
                let repeat = $('#repeat').val();
                $('#account-update').addClass('cwDisabled');
                $.ajax({
                    type: 'POST',
                    url: '{{ route("Web.Account.update") }}',
                    data : { password:password, repeat:repeat },
                    dataType: 'json',
                    success: function (data) {
                        iziToast.success({
                            message: "@lang('words.account-update-success')"
                        });
                        setTimeout(function(){
                            location.reload()
                        }, 1500)
                    },
                    error: function (data) {
                        setTimeout(function(){
                            iziToast.error({
                                message: validateItem(data)
                            });
                            $('#account-update').removeClass('cwDisabled');
                        }, 400)
                        
                    },
                });
            })
        });
    </script>
@endsection
@section('content')
<main class="main">
    <section class="pt-100 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false">
                                                <i class="fi-rs-settings-sliders mr-10"></i>@lang('words.homepage')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true">
                                                <i class="fi-rs-user mr-10"></i>@lang('words.my-info')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">
                                                <i class="fi-rs-shopping-bag mr-10"></i>@lang('words.my-order')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('Web.Logout.add') }}">
                                                <i class="fi-rs-sign-out mr-10"></i>@lang('words.logout')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show cw-mt-2" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">@lang('words.hello-user', ['name'=>Auth::user()->name_surname])</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade cw-mt-2" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>@lang('words.my-account')</h5>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>@lang('words.name-surname')</label>
                                                            <input class="form-control square" name="name" type="text" disabled value="{{ Auth::user()->name_surname }}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>@lang('words.phone')</label>
                                                            <input class="form-control square" name="name" type="text" disabled value="{{ Auth::user()->phone }}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>@lang('words.email')</label>
                                                            <input class="form-control square" name="name" type="text" disabled value="{{ Auth::user()->email }}">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>@lang('words.password')</label>
                                                            <input required="" class="form-control square" id="password" type="password">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>@lang('words.password-repeat')</label>
                                                            <input required="" class="form-control square" id="repeat" type="password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="button" id="account-update" class="btn btn-fill-out submit" name="submit">@lang('words.save')</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade cw-mt-2" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">@lang('words.my-order')</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td>Processing</td>
                                                                <td>$125.00 for 2 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$364.00 for 5 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td>Completed</td>
                                                                <td>$280.00 for 3 item</td>
                                                                <td><a href="#" class="btn-small d-block">View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade cw-mt-2" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Billing Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>3522 Interstate<br> 75 Business Spur,<br> Sault Ste. <br>Marie, MI 49783</address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>4299 Express Lane<br>
                                                            Sarasota, <br>FL 34249 USA <br>Phone: 1.941.227.4444</address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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