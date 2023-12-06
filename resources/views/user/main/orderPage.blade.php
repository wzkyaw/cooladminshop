@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    {{-- LINK TO BACK LIST PAGE --}}
    <button class="btn mb-3" style="background-color:rgba(208, 201, 16, 0.933); margin-left: 285px;">
        <a class=" text-decoration-none text-white" href="{{ route('user#home') }}"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>
    </button>
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 450px">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark position-sticky top-0">
                    <tr>
                        <th>order code</th>
                        <th>product Id</th>
                        <th>Qty</th>
                        <th>total</th>
                        <th>order date</th>
                        <th>order status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->order_code }}</td>
                            <td>{{ $d->product_id }}</td>
                            <td>{{ $d->qty }}</td>
                            <td>{{ $d->total }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>
                                @if ($d->order_status == 0)
                                    <span class="text-warning"><i class="fa-sharp fa-regular fa-clock me-2"></i>Pending</span>
                                @elseif($d->order_status == 1)
                                    <span class="text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                @elseif($d->order_status == 2)
                                    <span class="text-danger"><i class="fa-solid fa-xmark me-2"></i>Reject</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{-- {{ $order->links() }} --}}
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

