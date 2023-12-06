@extends('admin.layouts.master')

@section('title' , 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    {{-- LINK TO BACK LIST PAGE --}}
                    <button class="btn mb-3" style="background-color:rgba(47, 224, 44, 0.933); ">
                        <a class=" text-decoration-none text-white" href="{{ route('order#list') }}"><i class="fa-solid fa-circle-arrow mb-3-left me-2"></i>Back</a>
                    </button>

                    {{-- CARD FOR ORDER PRODUCT LISTS --}}
                    <div class="row col-5">
                        <div class="card mt-4">
                            <div class="card-body mb-2 mt-2  d-flex align-items-center" style="border-bottom: 1px solid rgb(216, 215, 215)">
                                <i class="fa-solid fa-receipt me-2"></i><h3 class="me-3">Order Info</h3> <small class="text-danger"> ( Included Delivery Charges! )</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"><i class="me-2 fa-solid fa-user"></i>Customer Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="me-2 fa-solid fa-barcode"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="me-2 fa-solid fa-clock"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-dollar-sign me-3"></i>Total</div>
                                    <div class="col">{{ $orderData->total_price }} Kyats</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DATA TABLE -->
                    <div class="table-data__tool" >
                        <div class="table-data__tool-left d-flex" style="width: 100px !improtant">
                            <div class="overview-wrap me-3" >
                                <h2 class="title-1">Order List</h2>
                            </div>

                            {{-- total order --}}
                            <div style="width: 50px">
                                <div style="background-color:rgba(47, 224, 44, 0.933); width:100%;" class="text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> -{{ count($orderList) }}</i></div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>order id</th>
                                    <th>product name</th>
                                    <th>product image</th>
                                    <th>quantity</th>
                                    <th>amount</th>
                                    <th>order date</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{ $o->id }}</td>
                                        <td>{{$o->product_name}}</td>
                                        <td><img class=" img-thumbnail" style="height: 100px" src="{{asset('storage/'.$o->product_image)}}"></td>
                                        <td>{{$o->qty}}</td>
                                        <td>{{$o->total}}</td>
                                        <td>{{$o->created_at->format('F-j-y')}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2 shadow pl-3">
                            {{-- {{ $order->links() }} --}}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
