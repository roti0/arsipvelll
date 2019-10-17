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
        $data = Attendance::join('users', function ($join) {
            $join->on('users.id', '=', 'attendances.userid')->join('jobs', 'jobs.id_jobs', '=', 'users.job')
                ->join('divisis', 'divisis.id_divisi', '=', 'jobs.divisi');
        })->whereDate('date_attendance', '=', Carbon::today()->toDateString());
        $attendances = $data->paginate(10);
        // $count = $data->count();
        // dd($count);
        return view('admin.attendance', compact('divisi', 'attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->divisi == 0) {
            $all = User::where('status', '=', '1')->get();
            foreach ($all as $data) {
                Attendance::create([
                    'userid' => $data->id,
                    'date_attendance' => $request['datefor'],
                    'start' => $request['start'],
                    'end' => $request['end']
                ]);
            }
        } else {
            $data = User::join('jobs', function ($join) {
                $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis', 'divisis.id_divisi', '=', 'jobs.divisi');
            })->where('id_divisi', '=', $request['divisi'])->where('status', '=', '1')
                ->get();
            foreach ($data as $item) {
                Attendance::create([
                    'userid' => $item->id,
                    'date_attendance' => $request['datefor'],
                    'start' => $request['start'],
                    'end' => $request['end']
                ]);
            }
        }
        return redirect()->back()->with('create', 'Succesfull create Attendance');
    }


    public function search(Request $request)
    {

        $divisi = Divisi::all();
        $date = Attendance::search($request->searchdate);
        $attendances = $date->paginate(10);
        // $count = $date->count();

        $attendances->appends($request->only('searchdate'));
        return view('admin.attendance', compact('divisi', 'attendances'));
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
            'time_pressence' => Carbon::now('Asia/Jakarta')->toTimeString(),
            'verified' => request('verified')
        ]);

        return redirect()->back();
    }

    public function userattendance(Attendance $attendance)
    {
        if (Carbon::now('Asia/Jakarta')->toTimeString() <= $attendance->end) {
            if (Carbon::now('Asia/Jakarta')->toTimeString() >= $attendance->start) {
                $attendance->update([
                    'time_pressence' => Carbon::now('Asia/Jakarta')->toTimeString(),
                    'verified' => request('verified')
                ]);
                $data = Attendance::where('userid', '=', $attendance->id)
                    ->whereDate('date_attendance', '=', Carbon::today()->toDateString());
                $user = $data->get();
                $count = $data->count();
                return redirect()->back()->with('user',$user)->with('count',$count);
            } else {
                return redirect()->back()->with('tattendance', 'To soon');
            }
        } else {
            return redirect()->back()->with('nattendance', 'Sorry you late');
        }
    }

    public function outattendance(Attendance $out)
    {
        if (Carbon::now('Asia/Jakarta')->toTimeString() >= $out->end) {
                $out->update([
                    'time_out' => Carbon::now('Asia/Jakarta')->toTimeString()
                ]);
                $data = Attendance::where('userid', '=', $out->id)
                    ->whereDate('date_attendance', '=', Carbon::today()->toDateString());
                $user = $data->get();
                $count = $data->count();
                return redirect()->back()->with('user',$user)->with('count',$count);
            
        } else {
            return redirect()->back()->with('nout', 'Sorry you Cant Out Now');
        }
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
