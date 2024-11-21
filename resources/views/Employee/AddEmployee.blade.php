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
                                    <h4 class="mb-sm-0">Add Employee</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modules</a></li>
                                            <li class="breadcrumb-item active">Employee</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <form  action="{{route('employee.store')}}" method="post" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                        <div class="row">
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="first_name">First Name</label>
                                                <input id="first_name" class="form-control" placeholder="First name" name="first_name" type="text">
                                            </div>
                                            @error('first_name')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="last_name">Last Name</label>
                                                <input id="last_name" class="form-control" placeholder="Last name" name="last_name" type="text">
                                            </div>
                                            @error('last_name')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="email">E-mail</label>
                                                <input id="email" class="form-control" placeholder="Email" name="email" type="email">
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="phone_number">Phone Number</label>
                                                <input id="phone_number" class="form-control" placeholder="Phone Number" name="phone_number" type="tel">
                                            </div>
                                            @error('phone_number')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="city">City</label>
                                                <input id="city" class="form-control" placeholder="city" name="city" type="text">
                                            </div>
                                            @error('city')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="address">Address</label>
                                                <input id="address" class="form-control" placeholder="Address" name="address" type="text">
                                            </div>
                                            @error('address')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="address">Birth Date</label>
                                                <input id="birthdate" class="form-control" placeholder="Birth Date" name="birthdate" type="date">
                                            </div>
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="address">Hire Date</label>
                                                <input id="hiredate" class="form-control" placeholder="hire Date" name="hiredate" type="date">
                                            </div>
                                            @error('hiredate')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="mb-4 col-lg-4">
                                                <label class="form-label" for="salary">Salary</label>
                                                <input id="salary" class="form-control" placeholder="Salary" name="salary" type="number">
                                            </div>
                                            @error('salary')
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
                                                @error('department_id')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Jobs</label>
                                                    <select class="form-control select2" name="job_id">
                                                        <option value="">Job </option>
                                                               @foreach ($jobs as $job)
                                                               <option value="{{$job->id}}"> {{$job->job_title}} </option>
                                                               @endforeach
                                                  </select>
                                                </div>
                                                @error('job_id')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Services</label>
                                                    <select class="form-control select2" name="service_id">
                                                        <option value="">Service </option>
                                                               @foreach ($services as $service)
                                                               <option value="{{$service->id}}"> {{$service->service_name}} </option>
                                                               @endforeach
                                                  </select>
                                                </div>
                                                @error('service_id')
                                                <div class="alert alert-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <button class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Employee</button>
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