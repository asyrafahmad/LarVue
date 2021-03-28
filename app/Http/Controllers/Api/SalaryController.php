<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id){
        
        $validateData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();

        if($check){
            return response()->json('Salary already paid.');
        }else{
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = $month;
            $data['salary_month'] = date('F');
            $data['salary_year'] = date('Y');
            DB::table('salaries')->insert($data);
        }

        
    }
}
