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
                                <a href="{{ route('admin#contactListPage') }}" class="text-white btn btn-dark">
                                    <i class="fa-solid fa-circle-arrow-left"></i> BACK
                                </a>
                            </div>
                            <div class="card-title mt-3 mb-5">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <label for="">Profile Photo</label>
                                        <div class=" text-center img-thumbnail">
                                            @if ($data->user_image == null)
                                                @if ($data->user_gender == 'male')
                                                    <img src="{{ asset('image/default_user_profile.jpg') }}" class=" rounded-circle">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" class=" rounded-circle">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$data->user_image) }}" class=" rounded-circle" alt="John Doe" />
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">User Id</label>
                                            <input id="cc-pament" disabled name="user_id" type="text" value="{{ old('user_id' , $data->user_id) }}" class="form-control @error('user_id') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter user_id">

                                            @error('user_id')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name" type="text" value="{{ old('name' , $data->name) }}" class="form-control @error('name') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name">

                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email" type="email" value="{{ old('email' , $data->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email">

                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Message</label>
                                            <input id="cc-pament" disabled name="message" type="text" value="{{ old('message' , $data->message) }}" class="form-control @error('message') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter message Number">

                                            @error('message')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment"  class="control-label mb-1">Subject</label>
                                            <input id="cc-pament" disabled name="subject" type="text" value="{{ old('subject' , $data->subject) }}" class="form-control @error('subject') is-invali @enderror" aria-required="true" aria-invalid="false" placeholder="Enter subject">

                                            @error('subject')
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
