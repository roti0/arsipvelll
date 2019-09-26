@extends('layouts.appadmin')

@section('content')
<div class="container">
        <div class="card shadow">
            <div class="card-header py-3">    
                @if (session('create'))
                <div class="alert" style="color:chartreuse" >{{session('create')}}</div>
                @endif
                @if (session('edit'))
                <div class="alert" style="color:chartreuse" >{{session('edit')}}</div>
                @endif
                <div class="row">
                        <div class="col-md-4">
                                <h6 class="m-0 font-weight-bold text-primary">Add New Jobs</h6>
                            <div class="container mt-3">
                                    <form class="form-group" action="{{route('admin.createjobs')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                                <label for="job_name">Job Name</label>
                                                <input type="text" name="job_name" class="form-control" id="" placeholder="Job Name">    
                                        </div>
                                        <div class="form-group">
                                                <label for="salary">Salary</label>
                                                <input type="text" name="salary" class="form-control" id="" placeholder="Salary">    
                                        </div>
                                        <div class="form-group">
                                            <label for="division">Division</label>
                                            <select class="form-control" name="divisi" id="">
                                                    <option value="" selected disabled >--Choose Division--</option>
                                                    @foreach ($divisi as $item)
                                                        <option value="{{$item->id_divisi}}">
                                                            {{$item->division_name}}
                                                        </option>
                                                    @endforeach
                                            </select>                                                    
                                        </div>         
                                        <hr>                               
                                        <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Jobs">
                                        </div>
                                        </form>            
                            </div>                        
                        </div>
                        <div class="col-md-8">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Jobs</h6>
                                <div class="card-body">
                                        <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                                            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                                                <thead>
                                                    <tr>
                                                            <th>Jobs</th>
                                                            <th>Division</th>
                                                            <th>Salary</th>
                                                            <th>Action</th>
                                                    </tr>
                                                    @foreach ($jobs as $data)
                                                    <tr>    
                                                            <td>{{$data->job_name}}</td>
                                                            <td>{{$data->division_name}}</td>
                                                            <td>{{$data->salary}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong-{{$data->id_jobs}}">
                                                                    Edit
                                                                </button>

                                                                <div class="modal fade" id="ModalLong-{{$data->id_jobs}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                          <div class="modal-content">
                                                                            <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Division</h5>
                                                                                  <a href="/division/{{$data->id_job}}/edit" type="button" class="close" data-dismiss="modal" aria-label="Close"></a>
                                                                                <span aria-hidden="true">&times;</span>
                                                                
                                                                            </div>
                                                                           <div class="modal-body">
                                                                               <form action="{{route('admin.updatejobs',$data)}}" method="POST">
                                                                                    @method('PATCH')
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                            <label for="job_name">Division Name</label>
                                                                                            <input type="text" name="job_name" class="form-control" id="" value="{{$data->job_name}}">    
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                            <label for="salary">Salary</label>
                                                                                            <input type="text" name="salary" class="form-control" id="" placeholder="Salary" value="{{$data->salary}}" >    
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="divisi">Division</label>
                                                                                        <select class="form-control" name="divisi" id="">                                                                                                
                                                                                                @foreach ($divisi as $item)
                                                                                                    <option value="{{$item->id_divisi}}" 
                                                                                                        @if ($data->id_divisi == $item->id_divisi)
                                                                                                            selected
                                                                                                        @endif>
                                                                                                        {{$item->division_name}}
                                                                                                    </option>
                                                                                                @endforeach
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

                                                </thead>
                                            </table>
                                        </div>
                                </div>
                        </div>
                    </div>
    </div>
</div>
@endsection