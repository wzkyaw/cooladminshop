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
                            <div>
                                <a href="{{ route('admin#details') }}" class="text-white btn btn-dark">
                                    <i class="fa-solid fa-circle-arrow-left"></i> BACK
                                </a>
                            </div>
                            <div class="card-title mt-3 mb-5">
                                <h3 class="text-center title-2">Account Info...</h3>
                            </div>

                            <form action="{{ route('admin#update' , Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <label for="">Profile Photo</label>
                                        <div class="">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_user_profile.jpg') }}" class=" img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" class=" img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class=" img-thumbnail shadow-sm" />
                                            @endif
                                        </div>

                                        <div class="form-group mt-4">
                                            <input type="file" name="image" class="form-control  @error('image') is-invalid  @enderror">

                                            @error('image')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name' , Auth::user()->name) }}" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name">

                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" value="{{ old('email' , Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email">

                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" value="{{ old('phone' , Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Phone Number">

                                            @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <input id="cc-pament" name="address" type="text" value="{{ old('address' , Auth::user()->address) }}" class="form-control @error('address') is-invali @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Address">

                                            @error('address')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control mb-1">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-7 offset-5 mb-3">
                                        <button class="btn btn-dark text-white" type="submit">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>Update Profile
                                        </button>
                                    </div>
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
