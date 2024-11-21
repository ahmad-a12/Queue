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
                                    <h4 class="mb-sm-0">Add Departments</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modules</a></li>
                                            <li class="breadcrumb-item active">Departments</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <form action="{{route('department.store')}}" method="post">
                                @csrf
                                <div class="row">
                                        <div class="row">
                                            <div class="mb-4 col-lg-6">
                                                <label class="form-label" for="department_name">Department Name</label>
                                                <input id="department_name" class="form-control" placeholder="Department Name" name="department_name" type="text">
                                            </div>
                                            @error('department_name')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                            <div>
                                                <button class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Department</button>
                                            </div>
                                        </div>
                                        
                                </div>
                            </form>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@stop
