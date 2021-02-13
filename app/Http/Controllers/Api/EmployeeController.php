<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Employee;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required',
        ]);

        //store image
        if($request->photo){
            // [START] finding the exact image/file name 
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            // [END] finding the exact image/file name 

            $name = time().".".$ext;                                         // naming the file uploaded
            $img = Image::make($request->photo)->resize(240,200);
            // TODO: location should be store in storage folder for more secure
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee               = new Employee;
            $employee->name         = $request->name;
            $employee->email        = $request->email;
            $employee->phone        = $request->phone;
            $employee->salary       = $request->salary;
            $employee->address      = $request->address;
            $employee->nid          = $request->nid;
            // $employee->joining_date = $request->joining_date;
            $employee->photo        = $image_url;
            $employee->save();
        }
        else{
            $employee               = new Employee;
            $employee->name         = $request->name;
            $employee->email        = $request->email;
            $employee->phone        = $request->phone;
            $employee->salary       = $request->salary;
            $employee->address      = $request->address;
            $employee->nid          = $request->nid;
            // $employee->joining_date = $request->joining_date;
            $employee->save();
        }

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
    public function update(Request $request, $id)
    {
        //
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
