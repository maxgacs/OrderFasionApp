<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order_detail;
use DB;

class Order_DetailController extends Controller
{
    
    public function AddOrder_Details(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

        $order_details = new order_detail();
        $order_details->priceTotal = $request->get('priceTotal');     
        $order_details->priceSizeF = $request->get('priceSizeF');
        $order_details->priceSizeS = $request->get('priceSizeS');
        $order_details->priceSizeM = $request->get('priceSizeM');
        $order_details->priceSizeL = $request->get('priceSizeL');    
        $order_details->priceSizeXL = $request->get('priceSizeXL');
        $order_details->priceSize2XL = $request->get('priceSize2XL');
        $order_details->priceSize3XL = $request->get('priceSize3XL');
        $order_details->quanTotal = $request->get('quanTotal');     
        $order_details->quanSizeF = $request->get('quanSizeF');
        $order_details->quanSizeS = $request->get('quanSizeS');
        $order_details->quanSizeM = $request->get('quanSizeM');
        $order_details->quanSizeL = $request->get('quanSizeL');    
        $order_details->quanSizeXL = $request->get('quanSizeXL');
        $order_details->quanSize2XL = $request->get('quanSize2XL');
        $order_details->quanSize3XL = $request->get('quanSize3XL');
        $order_details->productID = $request->get('productID');	
        $order_details->materialID = $request->get('materialID');	
        $order_details->orderID = $request->get('orderID');	

        //$users->walletID = $wallet->walletID;

        $order_details->save();                
        return response()->json(array(
            'message' => 'add a order_details successfully', 
            'status' => 'true'));  
        }



}