<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PaymentSalaries extends Model
{
    protected $primaryKey ='id_salaries';
    protected $fillable = [
        'datepayments','userid','bonus','salary_cuts'
    ];

}
