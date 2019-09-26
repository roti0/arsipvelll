@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="">
        <div class="card shadow">
          <div class="card-body p-0">
          <div class="row">
            <div class="container col-lg-5">
            <form class="user" action="{{route('admin.update',$data)}}" method="POST">
              {{ csrf_field() }}
              <h2 class="pt-2">Edit Employee</h2>
              @if (session('success'))
                  <div class="alert" style="color:chartreuse" >{{session('success')}}</div>
              @endif
              <hr>
                    <div class="form-group">
                    <label for="name">Name</label>
                      <input name="name" type="text" class="form-control "  value="{{$data->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                      <input name="email" type="email" class="form-control " value="{{$data->email}}" >
                    </div>
                    <div class="form-group">
                            <label for="address">Address</label>
                          <input name="address" type="text" class="form-control " value="{{$data->address}}" >
                        </div>
                    <div class="form-group">
                            <label for="birthdate">Birth Date</label>
                            <input name="birthdate" type="date" class="form-control " value="{{$data->birthdate}}" >
                            <div class="form-group">
                    </div>

                    <div class="form-group">
                      <label for="divisi">Division</label>
                      <select name="divisi" class="form-control" id="divisi">
                        @foreach ($divisi as $datadivisi)
                        <option value="{{$datadivisi->id_divisi}}"
                          @if ($datadivisi->id_divisi == $data->divisi)
                              selected
                          @endif
                          >{{$datadivisi->division_name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="job">Job</label>
                      <select name="job" class="form-control" id="job">
                        @foreach ($jobs as $job)
                        <option value="{{$job->id_jobs}}"
                          @if ($job->id_jobs == $data->job)
                              selected
                          @endif
                          >{{$job->job_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <hr>
                    
                    <div class="form-group">                      
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Employee Data">
                    </div>                    
            </form>
            </div>   
          </div>
          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
          </div> 
        </div>
    </div>

</div>
@endsection