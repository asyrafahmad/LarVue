<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Employee;
use Image;
use DB;

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
            'phone' => 'required|unique:employees',
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
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
        $data = array();
        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['phone']          = $request->phone;
        $data['salary']         = $request->salary;
        $data['address']        = $request->address;
        $data['nid']            = $request->nid;
        $data['joining_date']   = $request->joining_date;
        $new_image              = $request->newphoto;

        if($new_image){                                                                             // if NEW image is uploaded
            // [START] finding the exact image/file name 
            $position = strpos($new_image, ';');                                                
            $sub = substr($new_image, 0, $position);                                            // POSITION is at first array
            $ext = explode('/', $sub)[1];
            // [END] finding the exact image/file name 

            $name = time().".".$ext;                                                            // NAMING the file uploaded
            $img = Image::make($new_image)->resize(240,200);
            // TODO: location should be store in storage folder for more secure
            $upload_path = 'backend/employee/';                                                 // storage image location
            $image_url = $upload_path.$name;                                                    // NAMING the image file with path
            $success = $img->save($image_url);                                                  // save new image

            if($success){                                                                       // if got NEW IMAGE
                $data['photo'] = $image_url;                                                    // UPDATE existing data path in DB to new data path
                $img = DB::table('employees')->where('id',$id)->first();                        // FIND the id of image
                $image_path = $img->photo;                                                      // FIND the existing path of image
                $done = unlink($image_path);                                                    // UNLINK the existing image path
                $user = DB::table('employees')->where('id',$id)->update($data);                 // UPDATE all data from input form
            }
        }
        else{                                                                                   // if NO image is upload
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user = DB::table('employees')->where('id',$id)->update($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id',$id)->first();           // get all the data from id
        $photo = $employee->photo;

        if($photo){
            unlink($photo);                                                     // unlink image path
            DB::table('employees')->where('id',$id)->delete();
        }
        else{
            DB::table('employees')->where('id',$id)->delete();
        }
    }
}
