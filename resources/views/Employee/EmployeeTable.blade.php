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
                                    <h4 class="mb-sm-0">Employees</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modules</a></li>
                                            <li class="breadcrumb-item active">Employees</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="mb-1">
                                            <a href="{{route('employee.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Employee</a>
                                        </div>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Salary</th>
                                                <th>Hiredate</th>
                                                <th>age</th>
                                                <th>City</th>
                                                <th>Address</th>
                                                <th>Department</th>
                                                <th>Job</th>
                                                <th>Service</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            @foreach ($employees as $employee)
                                            @if ($employee->email !== 'ahmadagha485@gmail.com')
                                            <tr>
                                                  <td>{{$employee->id}}</td>
                                                  <td>{{$employee->first_name}}</td>
                                                  <td>{{$employee->last_name}}</td>
                                                  <td>{{$employee->email}}</td>
                                                  <td>{{$employee->phone_number}}</td>
                                                  <td>{{$employee->salary}}</td>
                                                  <td>{{$employee->hiredate}}</td>
                                                  <td>{{$employee->age}}</td>
                                                  <td>{{$employee->city}}</td>
                                                  <td>{{$employee->address}}</td>
                                                  <td>{{$employee->department->department_name}}</td>
                                                  <td>{{$employee->job->job_title}}</td>
                                                  <td>{{$employee->service->service_name}}</td>
                                                  <td>{{$employee->created_at}}</td>
                                                  <td>{{$employee->updated_at}}</td>
                                               <td>
          
                                                    <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-success">Update</a>
                                                    <a href="{{route('employee.destroy',$employee->id)}}" class="btn btn-danger">Delete</a>
          
      </td>
  </tr>
  @endif
  @endforeach
        
        
                                 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


@stop