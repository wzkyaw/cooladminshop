@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    {{-- LINK TO BACK LIST PAGE --}}
                    <button class="btn mb-3" style="background-color:rgba(47, 224, 44, 0.933); ">
                        <a class=" text-decoration-none text-white" href="{{ route('products#list') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
                    </button>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mt-3 mb-5">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>

                            <form action="{{ route('products#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $data->product_id }}">
                                        <label for="">Pizza Photo</label>
                                        <div class=" text-center img-thumbnail">
                                            <img src="{{ asset('storage/'.$data->image) }}" alt="John Doe" />
                                        </div>
                                        <div class="form-group mt-4">
                                            <input type="file" name="pizzaImage" class="form-control  @error('pizzaImage') is-invalid  @enderror">

                                            @error('pizzaImage')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaName')
                                                is-invalid
                                            @enderror">
                                                <option value="{{ old('pizzaCategory') }}">Choose Your Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input id="cc-pament" name="pizzaCategory" type="text" value="{{ old('pizzaCategory' , $data->category_name) }}" class="form-control @error('pizzaCategory') is-invali @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Category Id"> --}}
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName' , $data->name) }}" class="form-control @error('pizzaName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">

                                            @error('pizzaName')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" cols="30" rows="10" class="form-control @error('pizzaName') is-invalid  @enderror">{{ old('pizzaDescription' , $data->description) }}</textarea>

                                            @error('pizzaDescription')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="text" value="{{ old('pizzaPrice' , $data->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">

                                            @error('pizzaPrice')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="waitingTime" type="text" value="{{ old('waitingTime' , $data->waiting_time) }}" class="form-control @error('waitingTime') is-invali @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">

                                            @error('waitingTime')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control mb-1">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-7 offset-5 mt-3 mb-3">
                                        <button class="btn btn-dark text-white" type="submit">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>Update Pizza
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
