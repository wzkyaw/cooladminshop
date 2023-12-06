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
                                <h3 class="text-center title-2">Pizzas Details...</h3>
                            </div>

                            <div class="row align-items-center mb-3">
                                <div class="col-3 offset-3 shadow-sm p-1 img-thumbnail object-cover text-center">
                                    <img src="{{ asset('storage/'.$pizzas->image) }}" alt="John Doe" />
                                </div>
                                <div class="col-5 ms-4">
                                    <span class="my-2 d-block"><i class="fa-solid me-2 fa-passport"></i>Category - {{ $pizzas->category_name }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid me-2 fa-pizza-slice"></i>{{ $pizzas->name }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid me-2 fa-circle-info"></i>{{ $pizzas->description }}</span>
                                    <span class="my-2 d-block"><i class="fa-solid me-2 fa-clock"></i>about - {{ $pizzas->waiting_time }} minutes!</span>
                                    <span class="my-2 d-block"><i class="fa-solid me-2 fa-hand-holding-dollar"></i>{{ $pizzas->price }} Kyats!</span>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-4 offset-5 text-center mt-5 mb-3">
                                    <a href="">
                                        <button class="btn btn-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
