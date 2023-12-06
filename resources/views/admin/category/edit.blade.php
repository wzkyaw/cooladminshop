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
                        <a class=" text-decoration-none text-white" href="{{ route('category#list') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
                    </button>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Your Category</h3>
                            </div>
                            <hr>
                            <form action="{{ route('category#update' , $editData['category_id']) }}" method="post" novalidate="novalidate">
                                @csrf
                                <div>
                                    <input type="hidden" value="{{ $editData['category_id'] }}" name="editId">
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="categoryName" type="text" class="form-control @error('categoryName')
                                        is-invalid
                                    @enderror" value="{{ old( 'categoryName' , $editData['name'] ) }}" aria-required="true" aria-invalid="false" placeholder="Seafood...">

                                    @error('categoryName')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block text-white">
                                        <span id="payment-button-amount">Update</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
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
