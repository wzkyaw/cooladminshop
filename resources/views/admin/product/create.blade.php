@extends('admin.layouts.master')

@section('title' , 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    {{-- LINK TO BACK LIST PAGE --}}
                    <button class="btn mb-3" style="background-color:rgba(47, 224, 44, 0.933); ">
                        <a class=" text-decoration-none text-white" href="{{ route('products#list') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
                    </button>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('products#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName')
                                        is-invalid
                                    @enderror" value="{{ old('pizzaName') }}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">

                                    @error('pizzaName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory" class="form-control @error('pizzaName')
                                        is-invalid
                                    @enderror">
                                        <option value="{{ old('pizzaCategory') }}">Choose Your Category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('pizzaCategory')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" cols="30" rows="10" class="form-control @error('pizzaDescription')
                                        is-invalid
                                    @enderror" placeholder="Enter Your Description">{{ old('pizzaDescription') }}</textarea>

                                    @error('pizzaDescription')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage')
                                        is-invalid
                                    @enderror" value="{{ old('pizzaImage') }}" aria-required="true" aria-invalid="false" placeholder="Seafood...">

                                    @error('pizzaImage')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="waitingTime" type="number" class="form-control @error('waitingTime')
                                        is-invalid
                                    @enderror" value="{{ old('waitingTime') }}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time">

                                    @error('waitingTime')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group my-4">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice')
                                        is-invalid
                                    @enderror" value="{{ old('pizzaPrice') }}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">

                                    @error('pizzaPrice')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block text-white">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
