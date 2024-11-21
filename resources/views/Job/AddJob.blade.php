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
                                    <h4 class="mb-sm-0">Add Job</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modules</a></li>
                                            <li class="breadcrumb-item active">Jobs</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <form action="{{route('job.store')}}" method="post" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                        <div class="row">
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="job_title">Job title</label>
                                                <input id="job_title" class="form-control" placeholder="Job title" name="job_title" type="text">
                                            </div>
                                            @error('job_title')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="max_salary">Max Salary</label>
                                                <input id="max_salary" class="form-control" placeholder="Max Salary" name="max_salary" type="number">
                                            </div>
                                            @error('max_salary')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="min_salary">Min Salary</label>
                                                <input id="min_salary" class="form-control" placeholder="Min Salary" name="min_salary" type="number">
                                            </div>
                                            @error('min_salary')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select class="form-control select2" name="department_id">
                                                        <option value="">Department </option>
                                                               @foreach ($departments as $department)
                                                               <option value="{{$department->id}}"> {{$department->department_name}} </option>
                                                               @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                            @error('department_id')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div>
                                                <button class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Job</button>
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
