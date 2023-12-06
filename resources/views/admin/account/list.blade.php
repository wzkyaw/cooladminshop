@extends('admin.layouts.master')

@section('title' , 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool d-flex">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin Account List</h2>

                            </div>
                        </div>
                        {{-- total category --}}
                        <div class="col-2">
                            <div style="background-color:rgba(47, 224, 44, 0.933);" class=" text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ $admin->total() }}</i></div>
                        </div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1">
                        <form action="{{ route('admin#list') }}" method="get" class="d-flex">
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
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>gender</th>
                                        <th>address</th>
                                        <th>role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td class="col-1">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/default_user_profile.jpg') }}" class=" rounded-circle">
                                                    @else
                                                        <img src="{{ asset('image/female_default.png') }}" class=" rounded-circle">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.$a->image) }}" class="shadow-sm rounded-circle">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }} <input type="hidden" id="userId" value="{{ $a->id }}"></td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->address }}</td>

                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $a->id)
                                                    @else
                                                        <select name="roleStatus" id="changeStatus" class="me-5">
                                                            <option value="admin">Admin</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        <a href="{{ route('admin#changeRole' , $a->id) }}">
                                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Admin Change Role">
                                                                <i class="fa-solid fa-people-arrows"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin#delete' , $a->id) }}" class="mr-1">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 shadow pl-3">
                                {{ $admin->links() }}
                                {{-- {{-- {{ $categories->appends(request()->query())->links() }} --}}
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
            $('#changeStatus').change(function () {
                $currentStatus = $(this).val();
                $parentNodes = $(this).parents('tbody tr');
                $userId = $parentNodes.find('#userId').val();

                $data = {
                    'status' : $currentStatus ,
                    'userId' : $userId
                };

                $.ajax({
                    type : 'get' ,
                    url : '/admin/ajax/change/status' ,
                    data : $data,
                    dataType : 'json' ,
                });
                location.reload();
            });
        });
    </script>
@endsection
