<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Attendance;
use App\Divisi;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all();
        $divisi = Divisi::all();
        $data = Attendance::join('users',function($join){
            $join->on('users.id','=','attendances.userid')->join('jobs','jobs.id_jobs','=','users.job')
            ->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->whereDate('date_attendance','=',Carbon::today()->toDateString());
        $attendances = $data->get();
        $count = $data->count();
        // dd($count);
        return view('admin.attendance',compact('divisi','attendances','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->divisi == 0) {
            $all = User::where('status','=','1')->get();
            foreach ($all as $data) {
                Attendance::create([
                    'userid'=>$data->id,
                    'date_attendance'=>$request['datefor'],
                    'start'=>$request['start'],
                    'end'=>$request['end']
                ]);
            }
        } else {
            $data = User::join('jobs', function ($join) {
                $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
            })->where('id_divisi','=',$request['divisi'])->where('status','=','1')
            ->get();
            foreach ($data as $item) {
                Attendance::create([
                    'userid'=>$item->id,
                    'date_attendance'=>$request['datefor'],
                    'start'=>$request['start'],
                    'end'=>$request['end']
                ]);
            }
        }
        return redirect()->back()->with('create','Succesfull create Attendance');
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
    public function edit()
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
    public function update(Attendance $attendance)
    {
        $attendance->update([
            'time_pressence'=>Carbon::now('Asia/Jakarta')->toTimeString(),
            'verified'=>request('verified')
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
