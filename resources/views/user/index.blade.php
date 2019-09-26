@extends('layouts.appuser')

@section('content')
    <h1>HALO</h1>
    @if (session('notadmin'))
    <div class="alert" style="color:crimson" >{{session('notadmin')}}</div>
    @endif
@endsection