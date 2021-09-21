<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\employee;
use Livewire\WithPagination;
use DB;

class emps extends Component
{
    use WithPagination;

    public $confirmingEmpDeletion = false;
    public $emp;
    //public $confirmPicEmp = false;

    protected $rules = [
        'emp.empName' => 'required'
    ];

    public function render()
    {
        $sql="SELECT * FROM employees 
        INNER JOIN employee_types ON employees.empTypeID  = employee_types.empTypeID  
        ORDER BY empID DESC ";
         $emps=DB::select($sql);   

        return view('livewire.emps', [
            'emps' => $emps
        ]);
    }

    public function confirmEmpDeletion($emp)
    {
       // $emp->delete();
        $this->confirmingEmpDeletion = $emp;
    }

    public function deleteEmployee(employee $emp)
    {
         $emp->delete();
         $this->confirmingEmpDeletion = false;
         session()->flash('message','ลบพนักงานสำเร็จ');
    }
    
    public function join($id)
{
    $sql="SELECT * FROM employees
    INNER JOIN employee_types ON employees.empTypeID  = employee_types.empTypeID  
    WHERE employees.empID=$id";
    $emps=DB::select($sql)[0];
    return response()->json($emps);
}
    /*
    //pic
    public function picEmp(employee $emp)
    {
        $this->emp = $emp;
        $this->confirmPicEmp = true;
    }

    public function confirmPicEmp()
    {
        $this->reset(['emp']);
        $this->confirmPicEmp = true;
    }
    */
}
