<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'amount','salary_date','salary_month','salary_year'
    ];
}
