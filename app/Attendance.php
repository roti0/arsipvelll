<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey ='id_attendance';
    protected $fillable = [
        'userid','date_attendance','time_pressence','start','end','time_out','verified','created_at'
    ];
}
