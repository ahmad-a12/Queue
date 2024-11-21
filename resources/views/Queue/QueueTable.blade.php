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
                                    <h4 class="mb-sm-0">Queues</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Queues</a></li>
                                            <li class="breadcrumb-item active">Queues</li>
                                        </ol>
                                    </div>

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
                                                <a class="nav-link fw-bold p-3 active" href="#">Queues</a>
                                            
                                            </li>
                                        
                                        </ul>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Employee</th>
                                                    <th>Seat</th>
                                                    <th>Created at</th>
                                                    <th>Updated at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($queues as $queue)
                                                @if ($queue->status !== 'finished')
                                                <tr>
                                                    <td>{{ $queue->id }}</td>
                                                    <td>{{ $queue->user->email ?? $queue->user->phone_number }}</td>
                                                    <td>{{ $queue->service->service_name }}</td>
                                                    <td>{{ $queue->status }}</td>
                                                    <td>
                                                        @if($queue->status == 'pending')
                                                            <form action="{{ route('queue.update', $queue->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success">Activate</button>
                                                            </form>
                                                        @elseif($queue->status == 'active')
                                                            <form action="{{ route('queue.update', $queue->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger">Finish</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>{{ $queue->admin->email ?? 'N/A' }}</td>
                                                    <td>{{ $queue->seat_number ?? 'N/A'}}
                                                    <td>{{ $queue->created_at }}</td>
                                                    <td>{{ $queue->updated_at }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
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