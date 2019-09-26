<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Jobs;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $all = Jobs::all();
        $divisi = Divisi::all();
        $jobs = Jobs::join('divisis',function($join){
        $join->on('jobs.divisi','=','divisis.id_divisi');  
        })->get();
        // dd($jobs);
        return view('admin.jobsdivision',compact('jobs','divisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($request);
        Jobs::create([
            'job_name'=>request('job_name'),
            'salary'=>request('salary'),
            'divisi'=>request('divisi')
        ]);

        return redirect()->back()->with('create','You Have created a job');
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
    public function update(Request $request,Jobs $jobs)
    {

        $jobs->update([
            'job_name'=>$request['job_name'],
            'salary'=>$request['salary'],
            'divisi'=>$request['divisi']
        ]);
        return redirect()->back()->with('edit','Job Updated');
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
