<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\payment;
use DB;

class PaymentController extends Controller
{
    
    public function viewPayment($id)
    {
        $sql="SELECT * FROM payments";
        $payment=DB::select($sql);         
        return response()->json($payment);
    }

    public function AddPayment($id, Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

    
            $sql="SELECT * FROM orders
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];
    
            
        $payment = new payment();

        $file = $request->file('file');
        $paySlip = "";
        if(isset($file)){
            $file->move('assets/uploadfile/payment',$file->getClientOriginalName());
            $payment->paySlip = $file->getClientOriginalName();
        }      

        $payment->payPaid = $shop_cart->overdueMoney;
        $payment->orderID = $id;
        $payment->save();      
        
        

        return response()->json(array(
            'message' => 'add a deposit successfully', 
            'status' => 'true'));  

    }

    public function viewPaymentOrderID($id)
        {
            $sql="SELECT * FROM payments 
            WHERE payments.orderID=$id";
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