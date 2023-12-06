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
                                <h2 class="title-1">User List</h2>
                            </div>

                            {{-- total order --}}
                            <div style="width: 50px">
                                <div style="background-color:rgba(47, 224, 44, 0.933); width:100%;" class="text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ count($user) }}</i></div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1 mb-3">
                        <form action="{{ route('user#list') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="searchKey" class="form-control" placeholder="Search..." value="{{ request('searchKey') }}">
                            <button type="submit" style="background-color:rgba(47, 224, 44, 0.933);" class="btn text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th>gender</th>
                                    <th>role</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($user as $u)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/default_user_profile.jpg') }}" style="height: 100px" class=" rounded-circle">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" style="height: 100px" class=" rounded-circle">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$u->image) }}" style="height: 100px" class="rounded-circle" alt="John Doe" />
                                            @endif
                                        </td>
                                        <td>{{ $u->id }} <input type="hidden" id="userId" value="{{ $u->id }}"></td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>
                                            <select name="status" class="statusChange" class="form-control">
                                                <option value="user" @if($u->role == 'user') selected @endif>User</option>
                                                <option value="admin" @if($u->role == 'admin') selected @endif>Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#userListEdit' , $u->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#userListDelete' , $u->id) }}" class="mr-1">
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
                            {{ $user->links() }}
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
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'status' : $currentStatus ,
                    'userId' : $userId
                };

                $.ajax({
                    type : 'get' ,
                    url : '/user/change/status' ,
                    data : $data,
                    dataType : 'json'
                });

                location.reload();
            });

        });
    </script>
@endsection
