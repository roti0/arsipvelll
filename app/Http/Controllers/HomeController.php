<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

// use App\Http\Controllers\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $a = Auth::user()->level;
            if ($a==1&&Auth::user()->status==1) {
                $dashboard = User::join('jobs', function ($join) {
                $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
            })->where('status','=','1')
            ->get();
            // dd($dashboard);
            return view('admin.index',compact('dashboard'));
            } else if (Auth::user()->level==2&&Auth::user()->status==1) {
                return view('user.index');
            } else {
                Auth::logout();
                return redirect('login');
            }
        } else {
            return redirect('login');
        }     
        
    }
}
