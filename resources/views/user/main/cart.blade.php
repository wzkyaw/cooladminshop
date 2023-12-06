@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    {{-- LINK TO BACK LIST PAGE --}}
    <button class="btn mb-3 ms-5" style="background-color:rgba(208, 201, 16, 0.933);">
        <a class=" text-decoration-none text-white" href="{{ route('user#home') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
    </button>
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5" style="height: 450px;">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                        <input type="hidden" class="countOfCartList" value="{{ count($cartList) }}">
                        @foreach ($cartList as $c)
                            <tr>
                                <input type="hidden" value="{{ $c->pizza_price }}" id="pizzaPrice" >
                                <input type="hidden" id="qty" value="{{ $c->qty }}">
                                <td class="align-middle"><img src="{{ asset('storage/'.$c->pizza_image) }}" class="rounded-circle me-2" style="width: 70px;height:70px; object-fit:cover;"> {{ $c->pizza_name }}
                                    <input type="hidden" class="userId" value="{{ $c->user_id }}">
                                    <input type="hidden" class="productId" value="{{ $c->product_id }}">
                                    <input type="hidden" class="orderId" value="{{ $c->cart_id }}">
                                </td>
                                <td class="align-middle">{{ $c->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{ $totalPrice + 3000 }} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCartBtn">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function () {
            // when + button press to add price and qty
            $('.btn-plus').click(function () {
                $parentNodes = $(this).parents('tr');
                $price = $parentNodes.find('#pizzaPrice').val();
                $qty = Number($parentNodes.find('#qty').val());
                $total = $price * $qty;
                $parentNodes.find('#total').html($total + "Kyats");
                calculationPrice();

            });

            // when - button press to reduce price and qty
            $('.btn-minus').click(function () {
                $parentNodes = $(this).parents('tr');
                $price = $parentNodes.find('#pizzaPrice').val();
                $qty = Number($parentNodes.find('#qty').val());
                $total = $price * $qty;
                $parentNodes.find('#total').html($total + "Kyats");
                calculationPrice();
            });

            // when cross button press to remove current product
            $('.btnRemove').click(function () {
                $parentNodes = $(this).parents('tr');
                $productId = $parentNodes.find('.productId').val();
                $orderId = $parentNodes.find('.orderId').val();

                $.ajax({
                    type : 'get' ,
                    url :'/user/ajax/clear/current/product' ,
                    data : { 'productId' : $productId , 'orderId' : $orderId } ,
                    dataType : 'json' ,
                })
                $parentNodes.remove();
                calculationPrice();
            });

            // TOTAL SUMMARY
            function calculationPrice () {
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function (index,row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats" , ""));
                });
                $('#subTotalPrice').html(`${$totalPrice} Kyats`);
                $('#finalPrice').html(`${$totalPrice + 3000} Kyats`);
            }

            // ORDER LIST
            $('#orderBtn').click(function () {

                $countOfCartList = $('.countOfCartList').val();

                if ($countOfCartList != 0) {
                    $orderList = [];
                    $random = Math.floor(Math.random() * 100000001);
                    $('#dataTable tbody tr').each(function (index,row) {
                        $orderList.push ({
                            'user_id' : $(row).find('.userId').val(),
                            'product_id' : $(row).find('.productId').val(),
                            'qty' : $(row).find('#qty').val(),
                            'total' : $(row).find('#total').text().replace('Kyats' , '')*1,
                            'order_code' : 'POS' + $random
                        });
                    });

                    $.ajax ({
                        type : 'get' ,
                        url : '/user/ajax/order' ,
                        data : Object.assign({}, $orderList) ,
                        dataType : 'json' ,
                        success : function (response) {
                            if(response.status == 'true') {
                                window.location.href = '/user/homePage' ;
                            }
                        }
                    });
                }
            });

            // CLEAR CART
            $('#clearCartBtn').click(function () {
                $.ajax ({
                    type : 'get' ,
                    url : '/user/ajax/clear/cart' ,
                    dataType : 'json' ,
                });

                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 Kyat');
                $('#finalPrice').html('3000 Kyats');
            });
        });
    </script>
@endsection
