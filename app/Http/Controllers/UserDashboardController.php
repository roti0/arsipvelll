<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\PaymentSalaries;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::where('userid', '=', Auth::user()->id)->paginate(10);
        return view('user.myattendance', compact('attendance'));
    }

    public function payment()
    {
        $workday = Attendance::workday(Auth::user()->id, Carbon::today());
        $absent = Attendance::absent(Auth::user()->id, Carbon::today());
        $payment = PaymentSalaries::join('users', function ($join) {
            $join->on('users.id', '=', 'payment_salaries.userid')
                ->join('jobs', 'jobs.id_jobs', '=', 'users.job')
                ->join('divisis', 'divisis.id_divisi', '=', 'jobs.divisi');
        })->where('userid', '=', Auth::user()->id)->whereMonth('datepayments', Carbon::today()->month)->first();
        return view('user.myinvoice', compact('payment','workday','absent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
