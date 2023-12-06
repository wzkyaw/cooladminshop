@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mt-3 offset-md-1 mb-5">
                                <h3 class="text-center title-2">Account Info...</h3>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-7 offset-3 text-center">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default_user_profile.jpg') }}" class=" rounded-circle detailImg">
                                        @else
                                            <img src="{{ asset('image/female_default.png') }}" class=" rounded-circle detailImg">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle detailImg" />
                                    @endif
                                </div>
                                <div class="col-lg-5 col-md-7 offset-md-5 mt-2 ms-lg-4">
                                    <span class="my-2 d-block"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid fa-map-location-dot me-2"></i>{{ Auth::user()->address }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y h:m A') }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->gender }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 offset-5 offset-md-4 text-center mt-5 mb-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-md-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
