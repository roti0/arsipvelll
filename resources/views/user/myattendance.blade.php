@extends('layouts.appadmin')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                    <thead>
                        <th>Date</th>
                        <th>Start</th>
                        <th>Present</th>
                        <th>End</th>
                        <th>Out</th>
                        <th>Attendance</th>
                    </thead>
                    
                        @foreach ($attendance as $data)
                        <tr>

                        <td>{{$data->date_attendance}}</td>
                        <td>{{$data->start}}</td>
                        <td>
                            @if ($data->time_pressence==null)
                                <h5>Not Data</h5>
                            @else
                                {{$data->time_pressence}}
                            @endif
                        </td>
                        <td>{{$data->end}}</td>
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
                        </tr>
                        @endforeach                            
                </table>
        </div>
                {{$attendance->links()}}
    </div>
</div>
@endsection