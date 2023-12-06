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
                                <a href="{{ route('user#list') }}" class="text-white btn btn-dark">
                                    <i class="fa-solid fa-circle-arrow-left"></i> BACK
                                </a>
                            </div>
                            <div class="card-title mt-3 mb-5">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <form action="{{ route('admin#userListUpdate' , $data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <label for="">Profile Photo</label>
                                        <div class=" text-center img-thumbnail">
                                            @if ($data->image == null)
                                                @if ($data->gender == 'male')
                                                    <img src="{{ asset('image/default_user_profile.jpg') }}" class=" rounded-circle">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" class=" rounded-circle">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$data->image) }}" class=" rounded-circle" alt="John Doe" />
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name" type="text" value="{{ old('name' , $data->name) }}" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name">

                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($data->role == 'admin')
                                                    selected
                                                @endif>Admin</option>
                                                <option value="user" @if ($data->role == 'user')
                                                    selected
                                                @endif>user</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email" type="email" value="{{ old('email' , $data->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email">

                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled name="phone" type="text" value="{{ old('phone' , $data->phone) }}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Phone Number">

                                            @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Address</label>
                                            <input id="cc-pament" disabled name="address" type="text" value="{{ old('address' , $data->address) }}" class="form-control @error('address') is-invali @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Address">

                                            @error('address')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled class="form-control mb-1">
                                                <option value="male" @if ($data->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ($data->gender == 'female') selected @endif>Female</option>
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
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>Change
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
