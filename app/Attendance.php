<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey ='id_attendance';
    protected $fillable = [
        'userid','date_attendance','time_pressence','start','end','time_out','verified','created_at'
    ];

    public static function absent($id,$monthyear){
        $carbon = Carbon::parse($monthyear);
        $absent = Attendance::join('users',function($join){
            $join->on('users.id','=','attendances.userid');
        })->where('userid','=',$id)->where('verified','=',0)->whereMonth('date_attendance',$carbon->month)
        ->whereYear('date_attendance',$carbon->year)->count();

        return($absent);
    }

    public static function workday($id,$monthyear){
        $carbon = Carbon::parse($monthyear);
        $workday = Attendance::join('users',function($join){
            $join->on('users.id','=','attendances.userid');
        })->where('userid','=',$id)->where('verified','=',1)
        ->whereMonth('date_attendance',$carbon->month)
        ->whereYear('date_attendance',$carbon->year)->count();
        return($workday);
    }

    public static function search($data){

        $search = Attendance::join('users',function($join){
            $join->on('users.id','=','attendances.userid')->join('jobs','jobs.id_jobs','=','users.job')
            ->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->whereDate('date_attendance','=',$data);

        return $search;
    }
}
