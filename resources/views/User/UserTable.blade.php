@extends('Layouts/layout')

@section('content')

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">App Users</h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body  pt-0">

                                        <ul class="nav nav-tabs nav-tabs-custom mb-4">
                                            <li class="nav-item">
                                                <a class="nav-link fw-bold p-3 active" href="#">App Users</a>
                                            
                                            </li>
                                        
                                        </ul>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>E-mail</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                    <th>Created at</th>
                                                    <th>Updated at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone_number }}</td>
                                                    <td>
                                                        @if(!$user->banned)
                                                        <a href="{{ route('user.ban', $user->id) }}" class="btn btn-danger">Ban</a>
                                                        @else
                                                        <a href="{{ route('user.unban', $user->id) }}" class="btn btn-success">Unban</a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>{{ $user->updated_at }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                
                                        @if (session('banMessage'))
                                        <div class="alert alert-success">
                                            {{ session('banMessage') }}
                                        </div>
                                        @endif
                                        
                                        @if (session('unbanMessage'))
                                        <div class="alert alert-success">
                                            {{ session('unbanMessage') }}
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @stop