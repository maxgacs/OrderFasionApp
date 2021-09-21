<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\deposit;
use DB;

class DepositController extends Controller
{
    
    public function viewDeposit($id)
    {
        $sql="SELECT * FROM deposits";
        $deposit=DB::select($sql);         
        return response()->json($deposit);
    }

    public function AddDeposit($IDuser, Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

    
            $sql="SELECT SUM(priceTotal)/2 AS TotalAllPrice FROM shop_carts
            WHERE shop_carts.memberID=$IDuser";
            $shop_cart=DB::select($sql)[0];

            $sql2="SELECT * FROM orders ORDER BY orders.orderID DESC";
            $products=DB::select($sql2)[0];         
            
        $deposit = new deposit();

        $file = $request->file('file');
        $depositSlip = "";
        if(isset($file)){
            $file->move('assets/uploadfile/deposit',$file->getClientOriginalName());
            $deposit->depositSlip = $file->getClientOriginalName();
        }      

        $deposit->depositPaid = $shop_cart->TotalAllPrice;
        $deposit->orderID = $products->orderID;
        $deposit->save();      
        
        

        return response()->json(array(
            'message' => 'add a deposit successfully', 
            'status' => 'true'));  

    }

    public function viewDepositOrderID($id)
        {
            $sql="SELECT * FROM deposits 
            WHERE deposits.orderID=$id";
            $deposit=DB::select($sql)[0];         
            return response()->json($deposit);
        }

        public function viewDepositDESC(Request $request)
        {
            $sql="SELECT * FROM deposits ORDER BY deposits.DepositID DESC";
            $deposit=DB::select($sql)[0];         
            return response()->json($deposit);
        }

    public function AddImageDeposit(Request $request, $id)
    {
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);


        $file = $request->file('file');
        $depositSlip = "";
        if(isset($file)){
            $file->move('assets/uploadfile/deposit',$file->getClientOriginalName());
            $depositSlip = $file->getClientOriginalName();
        }      
        $deposit = deposit::find($id);
        $deposit->depositSlip = $depositSlip;

        $deposit->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }



}