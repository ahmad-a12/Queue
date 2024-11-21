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
                                    <h4 class="mb-sm-0">Seats</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master Modules</a></li>
                                            <li class="breadcrumb-item active">Seatss</li>
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
                                            <a href="{{route('seat.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus me-2"></i> Add Seat</a>
                                        </div>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Number</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            @foreach ($seats as $seat)
                                            <tr>
                                                  <td>{{$seat->number}}</td>
                                                  <td>{{$seat->created_at}}</td>
                                                  <td>{{$seat->updated_at}}</td>
                                               <td>

                                                    <a href="{{route('seat.destroy',$seat->number)}}" class="btn btn-danger">Delete</a>
          
      </td>
  </tr>
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