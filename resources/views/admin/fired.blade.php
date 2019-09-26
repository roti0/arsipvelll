@extends('layouts.appadmin')

@section('content')
<div class="container">
            <a href="{{route('home')}}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
                </span>
                <span class="text">Active Employee</span>
            </a>
            <a href="{{route('admin.fired')}}" class="btn btn-warning btn-icon-split ">
                    <span class="icon text-white-50">
            <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text">Fired Employee</span>
            </a>
        <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Fired Employee</h6>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                            <th>Name</th>
                                            <th>Last Position</th>
                                            <th>Last Division</th>
                                            <th>Hire Date</th>
                                            <th>Fired Date</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                    </tr>
                                </thead>
                                @foreach ($dashboard as $employee)
                                <tr>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->job_name}}</td>
                                        <td>{{$employee->division_name}}</td>
                                        <td>{{$employee->hiredate}}</td>
                                        <td>{{$employee->updated_at}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->salary}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection