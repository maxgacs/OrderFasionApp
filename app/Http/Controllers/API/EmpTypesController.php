<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employeeType;
use DB;

class EmpTypeController extends Controller
{
    
    public function viewEmpType(Request $request)
    {
        $sql="SELECT * FROM employee_types";
        $employees=DB::select($sql);         
        return response()->json($employees);
    }

    public function viewOneEmp($id)
    {
        $sql="SELECT * FROM employee_types 
               WHERE employee_types.empID=$id";
        $user=DB::select($sql)[0];         
        return response()->json($user);
    }

    
    public function updateEmp(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');

        $employee = employee::find($id);
        $employee->empName = $request->get('empName');     
        $employee->empAddress = $request->get('empAddress');
        $employee->empEmail = $request->get('empEmail');
        $employee->empPhone = $request->get('empPhone');
        $employee->empGender = $request->get('empGender');
        $employee->empUsername = $request->get('empUsername');


        $employee->save();

        return response()->json(array(
            'message' => 'update a employee successfully', 
            'status' => 'true'));
    }

    public function updateImageEmp(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);

        $employee = employee::find($id);

        $file = $request->file('file');
        if(isset($file)){
            $file->move('assets/uploadfile/user',$file->getClientOriginalName());
            $employee->image = $file->getClientOriginalName();
        }        

        $employee->save();

        return response()->json(array(
            'message' => 'update a employee successfully', 
            'status' => 'true'));
    }

}