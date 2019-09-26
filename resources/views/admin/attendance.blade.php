@extends('layouts.appadmin')

@section('content')
<div class="card shadow">
        <div class="card-body">
            <div class="row">
            <div class="container col-lg-4">
                <form class="user" action="{{route('admin.createattendance')}}" method="POST">
                    {{ csrf_field() }}
                    <h2 class="pt-2">Make Attendance</h2>
                        <hr>
                        <div class="form-group">
                            <label for="divisi">Division</label>
                            <select name="divisi" class="form-control" id="">
                                <option value="0">All</option>
                                @foreach ($divisi as $datadivisi)
                                <option value="{{$datadivisi->id_divisi}}"                          
                                    >{{$datadivisi->division_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                <label for="datefor">Date For</label>
                                <input type="date" name="datefor" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="time" class="form-control" name="start" id="" value="07:00">
                        </div>
                        <div class="form-group">
                            <label for="end">End</label>
                            <input name="end" type="time" class="form-control" value="14:00" >
                        </div>                                         
                        <hr>
                        
                        <div class="form-group">                      
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Employee data">
                        </div>                    
                </form>
            </div>  
            <div class="col-lg-8 d-lg-block">
                @if ($count!=0)
                <h2 class="pt-2">Today Attendance</h2>
                <hr>
                <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                        <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                            <thead>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Division</th>
                                <th>Salary</th>
                                <th>Date</th>
                                <th>Present</th>
                                <th>Out</th>
                                <th>Attendance</th>
                                <th>Action</th>
                            </thead>
                            
                                @foreach ($attendances as $data)
                                <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->job_name}}</td>
                                <td>{{$data->division_name}}</td>
                                <td>{{$data->salary}}</td>
                                <td>{{$data->date_attendance}}</td>
                                <td>
                                    @if ($data->time_pressence==null)
                                        <h5>Not Data</h5>
                                    @else
                                        {{$data->time_pressence}}
                                    @endif
                                </td>
                                <td>
                                        @if ($data->time_out==null)
                                        <h5>No Data</h5>
                                    @else
                                    {{$data->time_out}}
                                    @endif
                                </td>
                                <td>
                                    @if ($data->verified===1)
                                        <div class="rounded bg-success text-center p-1 text-white">
                                            Attended   
                                        </div>   
                                    @else
                                        <div class="rounded bg-danger text-center p-1 text-white">
                                            Absent   
                                        </div>
                                    @endif
                                </td>
                                <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong-{{$data->id_attendance}}">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="ModalLong-{{$data->id_attendance}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                    
                                                </div>
                                               <div class="modal-body">
                                                   <form action="{{route('admin.updateattendance',$data)}}" method="POST">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="form-group">
                                                                <label for="verified">Status</label>
                                                                <select name="verified" class="form-control" id="">
                                                                    <option value="0">Absent</option>
                                                                    <option value="1">Attendance</option>    
                                                                </select>    
                                                        </div>
                                                        <div class="form-group">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="input" class="btn btn-primary">Save changes</button>
                                                   </form>
                                            </div>                                                                
                                        </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                @endforeach                            
                        </table>
                </div>
                @else
                    <div class="h-100">
                        <div class="jumbotron" style="height: 100%;" >
                                <h2 >NO Attendance Today</h2>
                                <hr class="my-4">
                                <p>Search Another day</p>
                                <form action="" class="form-group center">
                                    <div class="form-group">
                                            <input type="date" class="form-control" style="width:200px;" name="searchdate">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-submit btn-lg" >Search</button>
                                </form>
                        </div>
                    </div>
                @endif
            </div> 
        </div>
    
    </div> 
</div>

@endsection