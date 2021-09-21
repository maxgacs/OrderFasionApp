<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\salary;
use DB;

class EmpController extends Controller
{
    public function login(Request $request)
    {
        $empUsername = $request->get('empUsername');
        $empPassword = sha1($request->get('empPassword'));
        $employees = employee::login($empUsername,$empPassword);
        if($employees){
            $employee = (array)$employees;
            $employee['message'] = 'success';
            $employee['status'] = 'true';    
           // $user['token'] = sha1($empUsername . $empPassword . "@%#XYaU12$");        
        }else{
            $employee = array(
                'message' => 'this employee is not found', 
                'status' => 'false');
        }

        return response()->json($employee);
    }

    public function createEmp(Request $request)
    {
    
        date_default_timezone_set('Asia/Bangkok');

        $empImage = "test.jpg";
        $employee = new employee();
        $employee->empName = $request->get('empName');     
        $employee->empAddress = $request->get('empAddress');
        $employee->empEmail = $request->get('empEmail');
        $employee->empPhone = $request->get('empPhone');
        $employee->empGender = $request->get('empGender');
        $employee->empStat = 0;  
        $employee->empStatus = 0;      
        $employee->empUsername = $request->get('empUsername');
        $employee->empPassword = sha1($request->get('empPassword'));  
        $employee->empImage = $empImage;
        $employee->bankCode = $request->get('bankCode');  
        $employee->bankID = $request->get('bankID');  
        $employee->empTypeID = $request->get('empTypeID');  

        //$users->walletID = $wallet->walletID;

         
        $employee->save();                
        return response()->json(array(
            'message' => 'add a employee successfully', 
            'status' => 'true'));  

    }
        
    public function viewEmp(Request $request)
    {
        $sql="SELECT * FROM employees ";
        $employees=DB::select($sql);         
        return response()->json($employees);
    }

    public function viewOneEmp($id)
    {
        $sql="SELECT * FROM employees 
            INNER JOIN employee_types ON employees.empTypeID  = employee_types.empTypeID 
            WHERE employees.empID=$id";  
            $user=DB::select($sql)[0];       
        return response()->json($user);
    }

    public function viewWaitingEmp(Request $request)
    {
        $sql="SELECT * FROM employees 
            INNER JOIN employee_types ON employees.empTypeID  = employee_types.empTypeID 
            WHERE employees.empStatus = 1";  
            $user=DB::select($sql);       
        return response()->json($user);
    }

    public function SelectIDEmployeesDESC()
    {
        $sql="SELECT * FROM `employees` ORDER BY empID DESC ";
        
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

    public function updateStatusEmp(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');

        $employee = employee::find($id);
        $employee->empStatus = $request->get('empStatus');     


        $employee->save();

        return response()->json(array(
            'message' => 'updateEmpStatus a employee successfully', 
            'status' => 'true'));
    }

    public function updateImageEmp(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'Image']);

        $file = $request->file('file');
        $imageFileName = "";
        if(isset($file)){
            $file->move('assets/uploadfile/user',$file->getClientOriginalName());
            $imageFileName = $file->getClientOriginalName();
        }        
        
        $employee = employee::find($id);
        $employee->empImage = $imageFileName;
        $employee->save();

        return response()->json(array(
            'message' => 'update a employee successfully', 
            'status' => 'true'));
    }

    public function SelectEmployeesTypeID1Updated_atASC()
    {
        $sql="SELECT * FROM employees 
        WHERE empTypeID = 1 AND empStat = 0
        ORDER BY updated_at ASC";
        
        $user=DB::select($sql);         
        return response()->json($user);

    }

    public function SelectEmployeesTypeID2Updated_atASC()
    {
        $sql="SELECT * FROM employees 
        WHERE empTypeID = 2 AND empStat = 0
        ORDER BY updated_at ASC";
        
        $user=DB::select($sql);         
        return response()->json($user);

    }

    public function SelectEmployeesTypeID3Updated_atASC()
    {
        $sql="SELECT * FROM employees 
        WHERE empTypeID = 3 AND empStat = 0
        ORDER BY updated_at ASC";
        
        $user=DB::select($sql);         
        return response()->json($user);

    }

    public function SelectEmployeesTypeID4Updated_atASC()
    {
        $sql="SELECT * FROM employees 
        WHERE empTypeID = 4 AND empStat = 0
        ORDER BY updated_at ASC";
        
        $user=DB::select($sql);         
        return response()->json($user);

    }

    public function updateEmpStat(Request $request, $id)
    {       
        
        date_default_timezone_set('Asia/Bangkok');
        $employee = employee::find($id);
        $employee->empStat = $request->get('empStat');     


        $employee->save();

        return response()->json(array(
            'message' => 'update a employee successfully', 
            'status' => 'true'));
    }

    public function updateEmpStat3(Request $request, $id)
    {       

        $sql="SELECT * FROM salary 
        WHERE orderDetailID != 0 AND empID = 0
        ORDER BY updated_at ASC";
        $salarydata=DB::select($sql)[0];         

        $idsalary = $salarydata->salaryID;
        
        $salary = salary::find($idsalary);
        $salary->empID = $id;     
        $salary->save();

        $employee = employee::find($id);
        $employee->empStat = $request->get('empStat');     
        $employee->save();

        return response()->json(array(
            'message' => 'update a employee successfully', 
            'status' => 'true'));
    }

    public function Empdelete($id)
        {
            date_default_timezone_set('Asia/Bangkok');
    
        $sql="DELETE FROM `employees`
        WHERE employees.empID=$id";
        
        $employees=DB::delete($sql);         
        return response()->json($employees);
        }

}