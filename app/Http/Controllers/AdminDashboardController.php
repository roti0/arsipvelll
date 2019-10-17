<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Divisi;
use App\Jobs;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Console\Input\Input;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all();
        $dashboard = User::join('jobs', function ($join) {
            $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->where('status','=','1')
        ->get();
        return view('admin.index',compact('dashboard'));
    }


    public function showfired()
    {
        $dashboard = User::join('jobs', function ($join) {
        $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->where('status','=','0')
        ->get();
        return view('admin.fired',compact('dashboard'));
    }

    public function fire(Request $request,$data){
        $user = User::find($data);
        if ($user->job == 1) {
            return redirect()->back()->with('errorfire'," Admin Can't be fired " );
        }else {
            $user->status = $request['fire'];
            $user->save();
            return $this->showfired();
        }      
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

    public function search(Request $request){
        $user = User::search(request('search'));

        $dashboard = $user->paginate(10);

        $dashboard->appends($request->only('search'));
        return view('admin.index',compact('dashboard'));
    }

    public function searchfire(Request $request){
        $user = User::searchfire(request('search'));

        $dashboard = $user->where('status','=','0')->paginate(10);

        $dashboard->appends($request->only('search'));
        return view('admin.fired',compact('dashboard'));
    }


    public function ajax($divisi_id) {
        // $divisi_id = Input::get('divisi_id');
        $job = Jobs::where('divisi','=',$divisi_id)->get();
        return response()->json($job);
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
        $data = User::join('jobs', function ($join) {
            $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->where('users.id','=', $id)
        ->first();
        // dd($data);
        $divisi = Divisi::all();
        $jobs = Jobs::all();
        return view('admin.editemployee',compact('data','divisi','jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        // dd($request,$data);
        $user = User::find($data);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->address = $request['address'];
        $user->birthdate = $request['birthdate'];
        $user->divisi = $request['divisi'];
        $user->save();
        return redirect()->back()->with('success','Your Employee Profile Has Been Updated');
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
