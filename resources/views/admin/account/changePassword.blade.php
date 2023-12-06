@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mt-2 mb-4">
                                <h3 class="text-center title-2">Change Your Password</h3>
                            </div>
                            @if (session('changeSuccess'))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check"></i> {{ session('changeSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Current Password</label>
                                    <input id="cc-pament" name="currentPassword" type="password"
                                        class="form-control
                                    @if (session('notMatch')) is-invalid @endif
                                        @error('currentPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Current Password">

                                    @error('currentPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    @if (session('notMatch'))
                                        <small class="invalid-feedback">{{ session('notMatch') }}</small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @error('newPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter New Password">

                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirmed Password</label>
                                    <input id="cc-pament" name="confirmedPassword" type="password"
                                        class="form-control @error('confirmedPassword')
                                        is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Confirmed Password">

                                    @error('confirmedPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit"
                                        class="btn btn-lg btn-info btn-block text-white">
                                        <i class="fa-solid fa-key me-2"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
