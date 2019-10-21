<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Divisi;
use App\PaymentSalaries;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisi = Divisi::all();
        $payment = PaymentSalaries::join('users',function($join){
            $join->on('users.id','=','payment_salaries.userid')
            ->join('jobs','jobs.id_jobs','=','users.job')
            ->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->paginate(8);
        // dd($payment);
        return view('admin.payment',compact('divisi','payment'));
    }

    public function download()
    {
        $payment = PaymentSalaries::join('users', function ($join) {
            $join->on('users.id', '=', 'payment_salaries.userid')
                ->join('jobs', 'jobs.id_jobs', '=', 'users.job')
                ->join('divisis', 'divisis.id_divisi', '=', 'jobs.divisi');
        })->where('userid', '=', Auth::user()->id)->whereMonth('datepayments', Carbon::today()->month)->first();
        $pdf = \PDF::loadView('user.download',$payment);
        return $pdf->download('invoice-'.Auth::user()->name.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $datepayments = Carbon::parse($request->monthfor)->toDateString();
        if ($request->divisi == 0) {
            $all = User::where('status','=','1')->get();
            foreach ($all as $data) {
                $salary_cuts = 0;
                $workday = Attendance::workday($data->id,$request->monthfor);
                $absent = Attendance::absent($data->id,$request->monthfor);
                $salary = User::employeeSalary($data->id);
                if ($absent!=0) {
                    if ($workday==0) {
                        $workday=1;
                        if ($workday<$workday) {
                            $salary_cuts = ($absent/$workday)*$salary;
                        } else {
                            $salary_cuts = $salary;
                        }
                    }
                }
                PaymentSalaries::create([
                    'userid'=>$data->id,
                    'datepayments'=>$datepayments,
                    'bonus'=>0,
                    'salary_cuts'=>$salary_cuts
                ]);
            }
        } else {
            $data = User::join('jobs', function ($join) {
                $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
            })->where('id_divisi','=',$request['divisi'])->where('status','=','1')
            ->get();
            foreach ($data as $item) {
                $workday = Attendance::workday($item->id,$request->monthfor);
                $absent = Attendance::absent($item->id,$request->monthfor);
                $salary = User::employeeSalary($item->id);
                if ($absent!=0) {
                    if ($workday==0) {
                        $workday=1;
                    }
                    $salary_cuts = ($absent/$workday)*$salary;
                }   
                PaymentSalaries::create([
                    'userid'=>$data->id,
                    'datepayments'=>$datepayments,
                    'bonus'=>0,
                    'salary_cuts'=>$salary_cuts
                ]);
            }
        }

        return redirect()->back();
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
    public function update(PaymentSalaries $payment)
    {
        $payment->update([
            'bonus' => request('bonus')
        ]);

        return redirect()->back();
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
