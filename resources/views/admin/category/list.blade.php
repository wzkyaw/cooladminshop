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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- total category --}}
                    <div class="col-1 offset-11 mb-4">
                        <div style="background-color:rgba(47, 224, 44, 0.933);" class=" text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ $categories->total() }}</i></div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1">
                        <form action="{{ route('category#list') }}" method="get" class="d-flex">
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
                    @if (session('deleteCategorySuccess'))
                        <div class="col-6 offset-6 my-4">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>  {{ session('deleteCategorySuccess') }}
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

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>category_id</th>
                                        <th>name</th>
                                        <th>created_at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->category_id }}</td>
                                            <td>
                                                <span>{{ $category->name }}</span>
                                            </td>
                                            <td>{{ $category->created_at->format('j-F-Y h:m A') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#edit' , $category->category_id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete' , $category->category_id) }}" class="mr-1">
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
                                {{-- {{ $categories->links() }} --}}
                                {{ $categories->appends(request()->query())->links() }}
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
