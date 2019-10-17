@extends('layouts.appadmin')

@section('content')
<div class="container">
        <a href="{{ route('home')}}" class="btn btn-primary btn-icon-split">
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
            <!-- Topbar Search -->
                <form action="{{route('admin.searchuser')}}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf    
                    <div class="input-group">
                            <input type="text" id="search" name="search" class="form-control border-0 small" placeholder="Search for Employee..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            </div>
                        </div>
                </form> 
                        
            @if (session('newemployee'))
                <div class="alert" style="color:chartreuse" >{{session('newemployee')}}</div>
            @endif

            @if (session('errorfire'))
            <div class="alert" style="color:crimson" >{{session('errorfire')}}</div>
            @endif
        <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Employee</h6>
        
                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Division</th>
                                            <th>Hire Date</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($dashboard as $employee)
                                <tr>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->job_name}}</td>
                                        <td>{{$employee->division_name}}</td>
                                        <td>{{$employee->hiredate}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->salary}}</td>
                                        <td>
                                                <button type="button" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#ModalLong-{{$employee->id}}">
                                                    <span class="icon text-white-50">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    </span>
                                                    <span class="text">Fire</span>
                                                </button>
                                                <a href="{{route('admin.edit',$employee->id)}}" class="btn btn-info btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-user-edit"></i>
                                                        </span>
                                                        <span class="text">Edit</span>
                                                </a>

                                                    <div class="modal fade" id="ModalLong-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title" id="exampleModalLongTitle">Fire Employee</h5>
                                                    
                                                                </div>
                                                                <form action="{{route('admin.fire',$employee->id)}}" method="POST">
                                                                <div class="modal-body">
                                                                    
                                                                            @method('PATCH')
                                                                            @csrf
                                                                            Select "Fire" below if you are ready to fire your current employee.
                                                                            <input type="hidden" name="fire" id="fire" value="0">
                                                                <div class="modal-footer">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="input" class="btn btn-warning">Fire</button>
                                                                    </div>
                                                                </div>                                                                            
                                                                </form>
                                                            </div>                                                                
                                                        </div>
                                                        </div>
                                                    </div>                                            
                                        </td>
                                </tr>
                                @endforeach
                            </table>
                            {{$dashboard->links()}}
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection