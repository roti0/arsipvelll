@extends('layouts.appadmin')

@section('content')
<div class="container">

  <div class="card">
    @if ($payment==null)
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Sorry</h1>
          <p class="lead">No Paymenth this month</p>
        </div>
      </div>
    @else
    <div class="card-header">
        Invoice
        <strong>{{ $payment->datepayments }}</strong>
        <span class="float-right"> <strong>Status:</strong> Pending</span>
  
      </div>
      <a href="{{ route('user.download') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-sm-6">
            <h6 class="mb-3">From:</h6>
            <div>
              <strong>ARSIPVEL INDONESIA</strong>
            </div>
            <div>Madalinskiego 8</div>
            <div>71-101 Szczecin, Poland</div>
            <div>Email: info@webz.com.pl</div>
          </div>
  
          <div class="col-sm-6">
            <h6 class="mb-3">To:</h6>
            <div>
            <strong>{{ $payment->name }}</strong>
            </div>
            <div>Job: {{ $payment->job_name }}</div>
            <div>{{ $payment->address }}</div>
            <div>Email: {{ $payment->email }}</div>
          </div>
        </div>
  
        <div class="table-responsive-sm">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="center">#</th>
                <th>Item</th>
                <th class="text-right">Unit Cost</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="center">1</td>
                <td class="left strong">Attendance</td>
                <td class="text-right">{{ $workday-$absent }}/{{ $workday }}</td>
              </tr>
              <tr>
                <td class="center">2</td>
                <td class="left">Salary</td>
                <td class="text-right">${{ $payment->salary }}</td>
              </tr>
              <tr>
                <td class="center">3</td>
                <td class="left">Bonus</td>
                <td class="text-right">${{ $payment->bonus }}</td>
              </tr>
              <tr>
                <td class="center">4</td>
                <td class="left">Salary Cuts</td>
                <td class="text-right">${{ $payment->salary_cuts }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-4">
  
          </div>
  
          <div class="col-lg-5 ml-auto">
            <table class="table table-clear">
              <tbody>
                <tr>
                  <td class="text-right">
                    <strong>Total</strong>
                  </td>
                  <td class="text-right">${{ $payment->salary-$payment->salary_cuts+$payment->bonus }}</td>
                </tr>
                
              </tbody>
            </table>
  
          </div>
  
        </div>
  
      </div>
    @endif
    
  </div>
</div>
@endsection