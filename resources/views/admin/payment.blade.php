@extends('layouts.appadmin')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <div class="row">
        <div class="container col-lg-4">
            <form class="user" action="{{route('admin.createpayment')}}" method="POST">
                {{ csrf_field() }}
                <h2 class="pt-2">Make Payment</h2>
                    <hr>
                    <div class="form-group">
                        <label for="divisi">Division</label>
                        <select name="divisi" class="form-control" id="">
                            <option value="0">All</option>
                            @foreach ($divisi as $item)
                                <option value="{{$item->id_divisi}}">{{$item->division_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="monthfor">Month For</label>
                            <input type="month" name="monthfor" class="form-control" id="">
                    </div>
                    <div class="form-group">                      
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Employee data">
                    </div>                    
            </form>
        </div>  
        <div class="col-lg-8 d-lg-block">
            <h2 class="pt-2">Payment</h2>
            <hr>
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                    <table width="100%" cellspacinf="0" class="table table-bordered" id="dataTable">
                        <thead>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Division</th>
                            <th>Salary</th>
                            <th>Bonus</th>
                            <th>Salary Cuts</th>
                            <th>Date Payment</th>
                            <th>Total</th>
                            <th>Action</th>
                        </thead>
                        @foreach ($payment as $data)                                     
                        <tr>                                                                                                                     
                                <td>{{$data->name}}</td>                        
                                <td>{{$data->job_name}}</td>
                                <td>{{$data->division_name}}</td> 
                                <td>{{$data->salary}}</td>                                      
                                <td><input class="form-control" type="text" name="bonus" id="bonus" form="form-{{$data->id_salaries}}" value="{{$data->bonus}}" ></td>
                                <td>{{$data->salary_cuts}}</td>
                                <td>{{$data->datepayments}}</td>
                                <td>{{$data->salary - $data->salary_cuts + $data->bonus}}</td>                                
                                <td><form class="form-group" method="post" action="{{route('admin.updatepayment',$data)}}" id="form-{{$data->id_salaries}}">
                                        @method('PATCH')                         
                                        @csrf
                                </form><button type="input" class="btn btn-primary" form="form-{{$data->id_salaries}}">Save changes</button></td>                                                                                             
                        </tr>
                        @endforeach
                    </table>
                    {{$payment->links()}}
            </div>
        </div> 
    </div>

</div> 
</div>
@endsection