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
                                <h2 class="title-1">Contact List</h2>
                            </div>

                            {{-- total order --}}
                            <div style="width: 50px">
                                <div style="background-color:rgba(47, 224, 44, 0.933); width:100%;" class="text-center py-1 rounded text-white"><i class="fa-solid fa-chart-simple"> - {{ count($contactData) }}</i></div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Searching Box --}}
                    <div class="col-3 offset-9 bg-white rounded p-1 mb-3">
                        <form action="{{ route('admin#contactListPage') }}" method="get" class="d-flex">
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
                                    <th>userid</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>subject</th>
                                    <th>message</th>
                                    <th>gender</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($contactData as $c)
                                    <tr class="tr-shadow">
                                        <td>
                                            @if ($c->image == null)
                                                @if ($c->user_gender == 'male')
                                                    <img src="{{ asset('image/default_user_profile.jpg') }}" style="height: 80px; width: 100px" class=" shadow rounded-circle">
                                                @else
                                                    <img src="{{ asset('image/female_default.png') }}" style="height: 80px; width: 100px" class="shadow rounded-circle">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$c->user_image) }}" style="height: 80px; width: 100px" class="shadow rounded-circle" alt="John Doe" />
                                            @endif
                                        </td>
                                        <td>{{ $c->user_id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->subject }}</td>
                                        <td>{{ $c->message }}</td>
                                        <td>{{ $c->user_gender }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#contactEditPage' , $c->user_id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#contactDelete' , $c->contact_id) }}" class="mr-1">
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
                            {{ $contactData->links() }}
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
