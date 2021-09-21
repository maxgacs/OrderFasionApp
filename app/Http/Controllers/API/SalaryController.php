<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\salary;
use DB;

class SalaryController extends Controller
{
    
    public function AddSalary(Request $request)
    {
    
        date_default_timezone_set('Asia/Bangkok');

        $salary = new salary();
        $salary->Salary = $request->get('Salary');
        $salary->statusOrder = $request->get('statusOrder');
        $salary->statusSalary = 0;

        $salary->empID = $request->get('empID');
        $salary->orderID = $request->get('orderID');
        $salary->save();                
        return response()->json(array(
            'message' => 'add a salary successfully', 
            'status' => 'true'));  

    }

    public function viewONEOrderUserProductIDJobEmp3($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT order_details.productID,products.productImage,product_types.typeName,
            salary.quanSizeF,salary.quanSizeS,salary.quanSizeM,
            salary.quanSizeL,salary.quanSizeXL,salary.quanSize2XL,
            salary.quanSize3XL,salary.quanSizeF + salary.quanSizeS + salary.quanSizeM +
            salary.quanSizeL + salary.quanSizeXL + salary.quanSize2XL + salary.quanSize3XL as Total,
            salary.orderID,product_types.patternRate,products.productName,salary.orderDetailID
            FROM salary 
            INNER JOIN orders ON salary.orderID = orders.orderID
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE salary.salaryID=$id 
            GROUP BY order_details.productID,products.productImage,product_types.typeName,
                    salary.quanSizeF,salary.quanSizeS,salary.quanSizeM,salary.quanSizeL,
                    salary.quanSizeXL,salary.quanSize2XL,salary.quanSize3XL,
                    salary.orderID,product_types.patternRate,products.productName,salary.orderDetailID";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewOrderUserColorGROUPJobEmp3($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT salary.orderDetailID,materials.materialColor,
                        salary.quanSizeF,salary.quanSizeS,salary.quanSizeM,
                        salary.quanSizeL,salary.quanSizeXL,salary.quanSize2XL,
                        salary.quanSize3XL,salary.quanSizeF + salary.quanSizeS + salary.quanSizeM +
                        salary.quanSizeL + salary.quanSizeXL + salary.quanSize2XL + salary.quanSize3XL as quanTotal
                        FROM salary
            INNER JOIN orders ON salary.orderID = orders.orderID
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN materials ON order_details.materialID = materials.materialID 
            WHERE salary.salaryID=$id
            GROUP BY salary.orderDetailID,materials.materialColor,
                    salary.quanSizeF,salary.quanSizeS,salary.quanSizeM,salary.quanSizeL,
                    salary.quanSizeXL,salary.quanSize2XL,salary.quanSize3XL";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

    public function AddSalaryEmpCut(Request $request)
    {
    
        date_default_timezone_set('Asia/Bangkok');

        /*$sql="SELECT * FROM employees
        WHERE empTypeID = 3 AND empStat = 0 ";
        $employees=DB::select($sql);       */
        
        

        /*$sql2="SELECT SUM(quanSizeF) as quanSizeF, SUM(quanSizeS) as quanSizeS, SUM(quanSizeM) as quanSizeM,
        SUM(quanSizeL) as quanSizeL,SUM(quanSizeXL) as quanSizeXL,SUM(quanSize2XL) as quanSize2XL,SUM(quanSize3XL) as quanSize3XL 
        FROM order_details
        WHERE orderID = $OrderID";
        $employees2=DB::select($sql2)[0];   

        $quanSizeF = $employees2->quanSizeF;
        $quanSizeS = $employees2->quanSizeS;
        $quanSizeM = $employees2->quanSizeM;
        $quanSizeL = $employees2->quanSizeL;
        $quanSizeXL = $employees2->quanSizeXL;
        $quanSize2XL = $employees2->quanSize2XL;
        $quanSize3XL = $employees2->quanSize3XL;
        
        $Total = $quanSizeF+$quanSizeS+$quanSizeM+$quanSizeL+$quanSizeXL+$quanSize2XL+$quanSize3XL;
        $TotalAll = ceil($Total/120);
        print $TotalAll;


*/
            $OrderID = $request->get('orderID');

            $sql="SELECT * FROM order_details
            WHERE orderID = $OrderID";
            $MatOrderID=DB::select($sql); 

        foreach($MatOrderID as $details){

            $sql2="SELECT * FROM order_details
            WHERE orderDetailID = $details->orderDetailID";
            $DetailID=DB::select($sql2)[0]; 

            $quanSizeF = $DetailID->quanSizeF;
            $quanSizeS = $DetailID->quanSizeS;
            $quanSizeM = $DetailID->quanSizeM;
            $quanSizeL = $DetailID->quanSizeL;
            $quanSizeXL = $DetailID->quanSizeXL;
            $quanSize2XL = $DetailID->quanSize2XL;
            $quanSize3XL = $DetailID->quanSize3XL;
        
            $Total = $quanSizeF+$quanSizeS+$quanSizeM+$quanSizeL+$quanSizeXL+$quanSize2XL+$quanSize3XL;
            $TotalAll = ceil($Total/120);
            

            for($i = 0; $i < $TotalAll; $i++)
            {

           
            $num = 0;

            $Total2 = $quanSizeF+$quanSizeS+$quanSizeM+$quanSizeL+$quanSizeXL+$quanSize2XL+$quanSize3XL;

            $salary = new salary();
            
            $salary->statusOrder = 0;
            $salary->statusSalary = 0;
            $salary->orderDetailID = $details->orderDetailID;
            $salary->orderID = $request->get('orderID');

               //F
                if($quanSizeF >= 121){
                $salary->quanSizeF = 120;
                $quanSizeF = $quanSizeF - 120;

                $num = $num + 120;
                $salary->Salary = $num*35;
                $salary->save();
                continue;
                

                }else if($quanSizeF <= 120){
                $salary->quanSizeF = $quanSizeF;
                $num = $num + $quanSizeF;
                $quanSizeF = $quanSizeF - $quanSizeF;
                
                }

                //S

                if($quanSizeS > 0){

               

                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $numS =  120 - $num;
                    if($numS > 0){

                        if($quanSizeS >= $numS){
                            $salary->quanSizeS = $numS;
                            $num = $num + $numS;
                            $quanSizeS = $quanSizeS - $numS;
                        }else{
                            $salary->quanSizeS = $quanSizeS;
                            $num = $num + $quanSizeS;
                            $quanSizeS = $quanSizeS - $quanSizeS;
                        }
                        
                    }
                }

            }


            if($quanSizeM > 0){
               
                //M
                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $numM = 120 - $num;
                    if($numM > 0){

                        if($quanSizeM >= $numM){
                            $salary->quanSizeM = $numM;
                            $num = $num + $numM;
                            $quanSizeM = $quanSizeM - $numM;

                        }else{
                            $salary->quanSizeM = $quanSizeM;
                            $num = $num + $quanSizeM;
                            $quanSizeM = $quanSizeM - $quanSizeM;
                            print $num;
                        }
                        
                    }
                }
            }
            if($quanSizeL > 0){
                //L
                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $numL = 120 - $num;

                    if($numL > 0){

                        if($quanSizeL >= $numL){
                            $salary->quanSizeL = $numL;
                            $num = $num + $numL;
                            $quanSizeL = $quanSizeL - $numL;
                        }else{
                            $salary->quanSizeL = $quanSizeL;
                            $num = $num + $quanSizeL;
                            $quanSizeL = $quanSizeL - $quanSizeL;
                        }
                        
                    }
                }
            }
            if($quanSizeXL > 0){
                //XL
                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $numXL = 120 - $num;

                    if($numXL > 0){

                        if($quanSizeXL >= $numXL){
                            $salary->quanSizeXL = $numXL;
                            $num = $num + $numXL;
                            $quanSizeXL = $quanSizeXL - $numXL;
                        }else{
                            $salary->quanSizeXL = $quanSizeXL;
                            $num = $num + $quanSizeXL;
                            $quanSizeXL = $quanSizeXL - $quanSizeXL;
                        }
                        
                    }
                }
            }
            if($quanSize2XL > 0){
                //2XL
                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $num2XL = 120 - $num;

                    if($num2XL > 0){

                        if($quanSize2XL >= $num2XL){
                            $salary->quanSize2XL = $num2XL;
                            $num = $num + $num2XL;
                            $quanSize2XL = $quanSize2XL - $num2XL;
                        }else{
                            $salary->quanSize2XL = $quanSize2XL;
                            $num = $num + $quanSize2XL;
                            $quanSize2XL = $quanSize2XL - $quanSize2XL;
                        }
                        
                    }
                }
            }
            if($quanSize3XL > 0){
                //3XL
                if($num >= 120){

                    $salary->Salary = $num*35;
                    $salary->save();
                    continue;

                }else{
                    $num3XL = 120 - $num;

                    if($num3XL > 0){

                        if($quanSize3XL >= $num3XL){
                            $salary->quanSize3XL = $num3XL;
                            $num = $num + $num3XL;
                            $quanSize3XL = $quanSize3XL - $num3XL;
                        }else{
                            $salary->quanSize3XL = $quanSize3XL;
                            $num = $num + $quanSize3XL;
                            $quanSize3XL = $quanSize3XL - $quanSize3XL;
                        }
                        
                    }
                    print $num;
                    
                    $salary->Salary = $num*35;
                    $salary->save();
                }

            }
            $salary->Salary = $num*35;
            $salary->save();
        }
        
        }     
        
    }

    public function viewSalaryJobEmpCutNull($id)
    {       
        date_default_timezone_set('Asia/Bangkok');
        $sql="SELECT * FROM salary 
        WHERE statusOrder = 0 AND orderDetailID != 0 AND orderID = $id";
        $salary=DB::select($sql);     
        
        return response()->json($salary);

    }


    public function viewSalaryDESC(Request $request)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM salary ORDER BY salary.salaryID DESC";
            $salary=DB::select($sql)[0];         
            return response()->json($salary);
        }

    public function UpImageSalary(Request $request, $id)
    {
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);


        $file = $request->file('file');
        $imageSalary = "test.jpg";
        if(isset($file)){
            $file->move('assets/uploadfile/salary',$file->getClientOriginalName());
            $imageSalary = $file->getClientOriginalName();
           
        }     
        $salary = salary::find($id);
        $salary->statusSalary = 1;
        $salary->imageSalary = $imageSalary;

        $salary->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }

    public function viewSalaryStatusOrder2(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $sql="SELECT * FROM salary 
        INNER JOIN employees ON salary.empID = employees.empID
        INNER JOIN employee_types ON employees.empTypeID = employee_types.empTypeID
        WHERE salary.statusOrder= 2 AND salary.statusSalary= 0";
        $salary=DB::select($sql);         
        return response()->json($salary);
    }

    public function viewSalaryOne($id)
    {
        date_default_timezone_set('Asia/Bangkok');
        $sql="SELECT * FROM salary 
        INNER JOIN employees ON salary.empID = employees.empID
        INNER JOIN banks ON employees.bankID = banks.bankID
        INNER JOIN employee_types ON employees.empTypeID = employee_types.empTypeID
        INNER JOIN orders ON salary.orderID = orders.orderID
        INNER JOIN members ON orders.memberID = members.memberID
        WHERE salary.salaryID= $id";
        $salary=DB::select($sql)[0];         
        return response()->json($salary);
    }

    public function viewSalaryEmpID($id)
    {
        date_default_timezone_set('Asia/Bangkok');
        $sql="SELECT * FROM salary 
        INNER JOIN employees ON salary.empID = employees.empID
        INNER JOIN employee_types ON employees.empTypeID = employee_types.empTypeID
        INNER JOIN orders ON salary.orderID = orders.orderID
        WHERE salary.empID= $id
        ORDER BY salary.statusSalary DESC";
        $salary=DB::select($sql);         
        return response()->json($salary);
    }

    public function viewQuanEndDateOrderID($id)
        {

            date_default_timezone_set('Asia/Bangkok');
            
            $effectiveDate2 = date('Y-m-d');

            $sql="SELECT * FROM salary 
            WHERE salary.salaryID = $id";
            $products=DB::select($sql)[0];         
  
            $effectiveDate1 = $products->endDate;
            $effectiveDate1 = (strtotime($effectiveDate1) - strtotime($effectiveDate2))/86400;

            $sql2="SELECT * FROM salary 
            WHERE salary.salaryID = $id";
            $products2=DB::select($sql2)[0];   
            
            $products2->Salary = $effectiveDate1;

            return response()->json($products2);

            //return response()->json($effectiveDate1);
        }
    

    public function viewOrderEmpComfirm($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM salary 
            INNER JOIN orders ON salary.orderID = orders.orderID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            INNER JOIN members ON orders.memberID = members.memberID
            WHERE salary.empID=$id ";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function updateSalaryStat(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
        $salary = salary::find($id);
        $salary->statusOrder = $request->get('statusOrder');     


        $salary->save();

        return response()->json(array(
            'message' => 'update a salary successfully', 
            'status' => 'true'));
        }

        public function updateSalaryStatStartDate(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
        $salary = salary::find($id);
        $salary->statusOrder = $request->get('statusOrder');  
        $salary->startDate = date('Y-m-d'); 
        $salary->endDate = $request->get('endDate');  


        $salary->save();

        return response()->json(array(
            'message' => 'update a salary successfully', 
            'status' => 'true'));
        }

        public function updateSalaryMoneyEmp(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
            $money = $request->get('SalaryNum');
            $money1 = $request->get('SalaryNum');
            $date = $request->get('Salary');
            $date = ($date * 20) / 100;
            $money1 = $money1 - ($money * $date);

        $salary = salary::find($id);
        $salary->Salary = $money1;  

        $salary->save();

        return response()->json(array(
            'message' => 'update a salary successfully', 
            'status' => 'true'));
        }

        public function updateSalaryStatEndDate(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
        $salary = salary::find($id);
        $salary->statusOrder = $request->get('statusOrder');  
        $salary->endDateReal = date('Y-m-d');    


        $salary->save();

        return response()->json(array(
            'message' => 'update a salary successfully', 
            'status' => 'true'));
        }

        public function viewSalaryWaiting($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM salary 
            WHERE salary.orderID = $id1 AND salary.empID = $id2";
            $products=DB::select($sql)[0];         
            return response()->json($products);
        }

        public function updateSalaryWaiting(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
            $salary = salary::find($id);
            $salary->empID = $request->get('empID');
            $salary->statusOrder = $request->get('statusOrder');     
    
    
            $salary->save();
    
            return response()->json(array(
                'message' => 'update a salary successfully', 
                'status' => 'true'));
        }

}