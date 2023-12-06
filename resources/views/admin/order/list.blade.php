@extends('admin.layouts.master')

@section('title' , 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool d-flex align-items-center" >
                        <div class="table-data__tool-left d-flex" style="width: 100px !improtant">
                            <div class="overview-wrap me-3" >
                                <h2 class="title-1">Order List</h2>
                            </div>

                            {{-- total order --}}
                            <div style="width: 50px">
                                <div style="background-color:rgba(47, 224, 44, 0.933); width:100%;" class="text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ count($order) }}</i></div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <form action="{{ route('order#changeList') }}" method="get">
                                @csrf
                                <div class="d-flex form-group">
                                    <label class="me-2 mt-1">Order Status</label>
                                    <div class="d-flex">
                                        <select name="orderStatus" class="form-control">
                                            <option value="all" @if (request('orderStatus') == 'all') selected @endif>All</option>
                                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                        </select>
                                        <button type="submit" class="btn text-white" style="background-color:rgba(47, 224, 44, 0.933);"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1 mb-3">
                        <form action="{{ route('order#list') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="searchKey" class="form-control" placeholder="Search..." value="{{ request('searchKey') }}">
                            <button type="submit" style="background-color:rgba(47, 224, 44, 0.933);" class="btn text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>user id</th>
                                    <th>user name</th>
                                    <th>order code</th>
                                    <th>amount</th>
                                    <th>order date</th>
                                    <th>status</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->order_id }}">
                                        <td class="col-2">{{ $o->user_id }}</td>
                                        <td class="col-2">{{ $o->user_name }}</></td>
                                        <td class="col-2">
                                            <a class=" text-decoration-none" href="{{ route('order#listInfo' , $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td class="col-2">{{ $o->total_price }}</td>
                                        <td class="col-2">{{ $o->created_at->format('F-j-Y h:m A') }}</td>
                                        <td class="col-2">
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if($o->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if($o->status == 1) selected @endif>Success</option>
                                                <option value="2" @if($o->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
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

@section('scriptSource')
    <script>
        $(document).ready(function () {
            // CHANGE STATUS
            $('.statusChange').change(function () {
                $currentStatus = $(this).val() ;
                $parentNode = $(this).parents('tbody tr');
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus ,
                    'orderId' : $orderId
                };

                $.ajax({
                    type : 'get' ,
                    url : '/order/ajax/change/status' ,
                    data : $data,
                    dataType : 'json' ,
                    success : function (response) {
                        console.log('success...');
                    }
                })
            })

        });
    </script>
@endsection
