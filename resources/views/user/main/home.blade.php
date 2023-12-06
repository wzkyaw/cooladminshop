@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal text-dark mb-2">{{ count($category) }}</span>
                        </div>
                        <hr>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}" class=" text-decoration-none text-dark">
                                 <label class="" for="price-1">All categories</label>
                            </a>
                        </div>

                        @foreach ($category as $c)
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                               <a href="{{ route('user#filter' , $c->category_id) }}" class=" text-decoration-none text-dark">
                                    <label class="" for="price-1">{{ $c->name }}</label>
                               </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <a href="{{ route('user#orderPage') }}">
                    <div class="">
                        <button class="btn btn btn-warning w-100">Order</button>
                    </div>
                </a>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-primary position-relative me-3">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>

                                <a href="{{ route('user#history') }}">
                                    <button type="button" class="btn btn-primary position-relative me-3">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                                            {{ count($order) }}
                                        </span>
                                    </button>
                                </a>

                                <a href="{{ route('user#contactListPage') }}">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-paper-plane me-2"></i>Contact
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-full bg-dark">
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="me-4">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Acending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="row" id="dataList">
                        @if (count($category) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" style="height:280px; object-fit:cover">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#cartList') }}"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails' , $p->product_id) }}"><i class="fa-solid fa-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} Kyats</h5>
                                                {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center bg-secondary text-white fs-1 col-6 offset-3 py-5">oops! sorry, here is no pizza</h3>
                        @endif
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function () {

        $('#sortingOption').change(function () {
            $eventOption = $('#sortingOption').val();

            // ASCENDING OPTION => first in last out
            if ($eventOption == 'asc') {
                $.ajax ({
                    type : 'get' ,
                    url : '/user/ajax/pizza/list' ,
                    data : { 'status' : 'asc' } ,
                    dataType : 'json' ,
                    success : function (response) {
                        $list = "";
                        for (let $i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height:280px; object-fit:cover">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} Kyats</h5>
                                            {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div> `;
                        }
                        $('#dataList').html($list);

                    }
                });

            // DESCENDING OPTION => last in first out
            }else if ($eventOption == 'desc') {
                $.ajax ({
                    type : 'get' ,
                    url : '/user/ajax/pizza/list' ,
                    data : { 'status' : 'desc' } ,
                    dataType : 'json' ,
                    success : function (response) {
                        $list = "";
                        for (let $i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height:280px; object-fit:cover">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} Kyats</h5>
                                            {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div> `;
                        }
                        $('#dataList').html($list);
                    }
                });
            }
        });
    });
</script>
@endsection
