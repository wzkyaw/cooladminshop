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
                        <th>name</th>
                        <th>order code</th>
                        <th>order date</th>
                        <th>amount</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                        <tr>
                            <td>{{ $o->user_name }}</td>
                            <td>{{ $o->order_code }}</td>
                            <td>{{ $o->created_at->format('F-j-Y h:m A') }}</td>
                            <td>{{ $o->total_price }}</td>
                            <td>
                                @if ($o->status == 0)
                                    <span class="text-warning"><i class="fa-sharp fa-regular fa-clock me-2"></i>Pending</span>
                                @elseif($o->status == 1)
                                    <span class="text-success"><i class="fa-solid fa-check me-2"></i>Success</span>
                                @elseif($o->status == 2)
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
