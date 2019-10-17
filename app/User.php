<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','job','hiredate','birthdate','level','status','updated_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function employeeSalary($id){
        $data = User::join('jobs',function($join){
            $join->on('jobs.id_jobs','=','users.job');
        })->where('id','=',$id)->first();
        return($data->salary);
    }

    public static function search($data){
        $search = User::join('jobs', function ($join) {
            $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->where('status','=','1')->where('name','LIKE',"%$data%")
        ->orWhere('email','LIKE',"%$data%")->orWhere('job_name','LIKE',"%$data%")->orWhere('division_name','LIKE',"%$data%");

        return $search;
    }

    public static function searchfire($data){
        $search = User::join('jobs', function ($join) {
            $join->on('jobs.id_jobs', '=', 'users.job')->join('divisis','divisis.id_divisi','=','jobs.divisi');
        })->where('status','=','0')->where('name','LIKE',"%$data%")
        ->orWhere('email','LIKE',"%$data%")->orWhere('job_name','LIKE',"%$data%")->orWhere('division_name','LIKE',"%$data%");

        return $search;
    }

}
