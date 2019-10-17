@extends('layouts.appadmin')

@section('content')
    <h1>Home</h1>
    @if (session('notadmin'))
    <div class="alert" style="color:crimson" >{{session('notadmin')}}</div>
    @endif
    @if (session('nattendance'))
    <div class="alert" style="color:crimson" >{{session('nattendance')}}</div>
    @endif
    @if (session('tattendance'))
    <div class="alert" style="color:crimson" >{{session('tattendance')}}</div>
    @endif
    @if (session('nout'))
    <div class="alert" style="color:crimson" >{{session('nout')}}</div>
    @endif
    <div class="jumbotron">
        <h1 class="display-4">Hello, {{Auth::user()->name}}</h1>
        <p class="lead">This Is Your Attendance today</p>
        <hr class="my-4">
        @if ($count>=1)
        <div class="table-responsive">
            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                <thead>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>In</th>
                    <th>Out</th>
                </thead>

                @foreach ($user as $data)
                    <tr>
                        <td>{{$data->date_attendance}}</td>
                        <td>{{$data->start}}</td>
                        <td>{{$data->end}}</td>
                        <td>
                            @if ($data->verified==1)
                            <div class="rounded bg-success text-center p-1 text-white">
                                You Have been Attended   
                            </div>
                            @else
                            <form action="{{route('user.attendance',$data)}}" method="POST" class="form-group center">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8">                                        
                                        <div class="form-group">
                                            <select class="form-control" name="verified" id="" required>
                                                <option value="" disabled selected >--Your Attendance--</option>
                                                <option value="1">Attendance</option>
                                                <option value="0">Absent</option>
                                            </select>
                                        </div>            
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </td>
                        <td>
                            @if ($data->time_out===null)
                            <form action="{{route('user.outattendance',$data)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                        <div class="col-lg-8">                                        
                                            <div class="form-group">
                                                <select class="form-control" name="out" id="out" required>
                                                    <option value="" disabled selected >--Out Now ??--</option>
                                                    <option value="1">Out Now</option>
                                                </select>
                                            </div>            
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" >Submit</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            @else
                                <div class="rounded bg-success text-center p-1 text-white">
                                    You Have Been Out    
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                
            </table>
        </div>
        @else
        <h1 class="display-4">Sorry, No Attendance Today</h1>
        @endif        
    </div>

    
@endsection