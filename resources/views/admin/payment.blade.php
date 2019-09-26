@extends('layouts.appadmin')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="row">
        <div class="container col-lg-4">
            <form class="user" action="" method="POST">
                {{ csrf_field() }}
                <h2 class="pt-2">Make Attendance</h2>
                    <hr>
                    <div class="form-group">
                        <label for="divisi">Division</label>
                        <select name="divisi" class="form-control" id="">
                            <option value="0">All</option>
                            
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
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalLong">
                                    Edit
                                </button>

                                <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                
                                            </div>
                                           <div class="modal-body">
                                               <form action="" method="POST">
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
                                                        
                    </table>
            </div>
        </div> 
    </div>

</div> 
</div>
@endsection