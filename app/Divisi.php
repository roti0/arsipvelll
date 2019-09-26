<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $primaryKey ='id_divisi';
    protected $fillable = [
        'division_name'
    ];
}