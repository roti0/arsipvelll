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
                                <h6 class="m-0 font-weight-bold text-primary">Add New Division</h6>
                            <div class="container mt-3">
                                    <form class="form-group" action="{{route('admin.createdivisi')}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                                <label for="division_name">Division Name</label>
                                                <input type="text" name="division_name" class="form-control" id="" placeholder="Division Name">    
                                        </div>                                        
                                        <div class="form-group">
                                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Division">
                                        </div>
                                        </form>            
                            </div>                        
                        </div>
                        <div class="col-md-8">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Division</h6>
                                <div class="card-body">
                                        <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive" style="height:300px;" >
                                            <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                                                <thead>
                                                    <tr>
                                                            <th>Division</th>
                                                            <th>Action</th>
                                                    </tr>
                                                    @foreach ($divisi as $data)
                                                    <tr>    
                                                            <td>{{$data->division_name}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong-{{$data->id_divisi}}">
                                                                    Edit
                                                                </button>

                                                                <div class="modal fade" id="ModalLong-{{$data->id_divisi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                          <div class="modal-content">
                                                                            <div class="modal-header">
                                                                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Division</h5>                                        
                                                                                <span aria-hidden="true">&times;</span>
                                                                
                                                                            </div>
                                                                           <div class="modal-body">
                                                                               <form action="{{route('admin.updatedivisi',$data)}}" method="POST">
                                                                                    @method('PATCH')
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                            <label for="division_name">Division Name</label>
                                                                                            <input type="text" name="division_name" class="form-control" id="" value="{{$data->division_name}}">    
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