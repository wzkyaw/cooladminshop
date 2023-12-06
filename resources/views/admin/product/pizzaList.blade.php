@extends('admin.layouts.master')

@section('title' , 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- total category --}}
                    <div class="col-1 offset-11 mb-4">
                        <div style="background-color:rgba(47, 224, 44, 0.933);" class=" text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ $pizzas->total() }}</i></div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1">
                        <form action="{{ route('products#list') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="searchKey" class="form-control" placeholder="Search..." value="{{ request('searchKey') }}">
                            <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    {{-- create category success alert --}}
                    @if (session('createCategorySuccess'))
                        <div class="col-6 offset-6 my-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>  {{ session('createCategorySuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- delete category success alert --}}
                    @if (session('deleteSuccess'))
                        <div class="col-6 offset-6 my-4">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>  {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- update category success alert --}}
                    @if (session('updateCategorySuccess'))
                        <div class="col-6 offset-6 my-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>  {{ session('updateCategorySuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- update pizza success alert --}}
                    @if (session('updatePizzaSuccess'))
                        <div class="col-6 offset-6 my-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>  {{ session('updatePizzaSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2" style="height: 100%">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>category</th>
                                        <th>price</th>
                                        <th>view count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{ asset('storage/'.$p->image) }}" class="shadow-sm" style="height: 100px; width: 120px;"></td>
                                            <td class="col-2">{{ $p->name }}</td>
                                            <td class="col-2">{{ $p->category_name }}</td>
                                            <td class="col-2">{{ $p->price }}</td>
                                            <td class="col-2"><i class="fa-solid fa-eye"></i>  {{ $p->view_count }}</td>
                                            <td class="">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('products#edit' , $p->product_id) }}" class="mr-1">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#updatePage' , $p->product_id) }}" class="mr-1">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#delete' , $p->product_id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 shadow pl-3">
                                {{ $pizzas->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>
                        </div>
                    @else
                        <h4 class="text-secondary text-center mt-5">There is no data to show!</h4>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
