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
                                    <h4 class="mb-sm-0">Jobs</h4>

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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="mb-1">
                                            <a href="{{route('job.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Job</a>
                                        </div>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Min salary</th>
                                                <th>Max salary</th>
                                                <th>Department</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            @foreach ($jobs as $job)
                                            @if ($job->job_title !== 'job')
                                            <tr>
                                                  <td>{{$job->id}}</td>
                                                  <td>{{$job->job_title}}</td>
                                                  <td>{{$job->min_salary}}</td>
                                                  <td>{{$job->max_salary}}</td>
                                                  <td>{{$job->department->department_name}}</td>
                                                  <td>{{$job->created_at}}</td>
                                                  <td>{{$job->updated_at}}</td>
                                               <td>
          
                                                    <a href="{{route('job.edit',$job->id)}}" class="btn btn-success">Update</a>
                                                    <a href="{{route('job.destroy',$job->id)}}" class="btn btn-danger">Delete</a>
          
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