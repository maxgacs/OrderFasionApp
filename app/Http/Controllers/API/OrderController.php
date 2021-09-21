<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\product;
use DB;

class OrderController extends Controller
{
    
    public function AddOrder(Request $request)
    {

        date_default_timezone_set('Asia/Bangkok');
        $effectiveDate2 = date('Y-m-d');
        $i = $request->get('dateline');
        $effectiveDate2 = strtotime("+".$i." day", strtotime($effectiveDate2));
        

        $order = new order();
        $order->overdueMoney = $request->get('overdueMoney');     
        $order->stepStatusID = 0;
        $order->memberID = $request->get('memberID');
        $order->dateline = date('Y-m-d',$effectiveDate2);
        $order->save();                
        return response()->json(array(
            'message' => 'add a order successfully', 
            'status' => 'true'));  
        }
        public function viewOrderID($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];      
            
            return response()->json($shop_cart);
        }

        
        
        public function viewQuanDatelineOrderID($id)
        {

            date_default_timezone_set('Asia/Bangkok');
            $effectiveDate2 = date('Y-m-d');

            $sql="SELECT * FROM orders
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];      
            
            $effectiveDate1 = $shop_cart->dateline;
            $effectiveDate1 = (strtotime($effectiveDate1) - strtotime($effectiveDate2))/86400;

            $sql2="SELECT * FROM orders
            WHERE orders.orderID=$id";
            $shop_car2t=DB::select($sql2)[0];
            
            $shop_car2t->text_alert = $effectiveDate1;

            return response()->json($shop_car2t);

            //return response()->json($effectiveDate1);
        }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function ViewSUM3Dateline($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT (SUM(order_details.quanTotal)/24)+1 AS DatelineS3 FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql);  

            return response()->json($shop_cart);
        }

        public function ViewSUM3Dateline2($id1)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM salary
            WHERE salary.salaryID=$id1";
            $salary=DB::select($sql)[0];

            
            $quanSizeF = $salary->quanSizeF;
            $quanSizeS = $salary->quanSizeS;
            $quanSizeM = $salary->quanSizeM;
            $quanSizeL = $salary->quanSizeL;
            $quanSizeXL = $salary->quanSizeXL;
            $quanSize2XL = $salary->quanSize2XL;
            $quanSize3XL = $salary->quanSize3XL;

            $id2 = $salary->orderID;
            

            $Total = $quanSizeF+$quanSizeS+$quanSizeM+$quanSizeL+$quanSizeXL+$quanSize2XL+$quanSize3XL;

            $TotalAll = ceil($Total/24);

            $effectiveDate2 = date('Y-m-d');
            $effectiveDate2 = strtotime("+".$TotalAll." day", strtotime($effectiveDate2));
            $effectiveDate2 = date('Y-m-d',$effectiveDate2);

            $sql="SELECT * FROM orders
            WHERE orders.orderID=$id2";
            $shop_cart=DB::select($sql)[0];
            
            $shop_cart->dateline = $effectiveDate2;

            return response()->json($shop_cart);

        }

        public function ViewSUM1_4Dateline($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $effectiveDate2 = date('Y-m-d');
            $effectiveDate2 = strtotime("+".$id1." day", strtotime($effectiveDate2));
            $effectiveDate2 = date('Y-m-d',$effectiveDate2);
            
            $sql="SELECT * FROM orders
            WHERE orders.orderID=$id2";
            $shop_cart=DB::select($sql)[0];
            
            $shop_cart->dateline = $effectiveDate2;

            return response()->json($shop_cart);
        }

        public function updateImageCompensation(Request $request, $id)
        {
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);


        $file = $request->file('file');
        $imageCompensation = "";
        if(isset($file)){
            $file->move('assets/uploadfile/compensation',$file->getClientOriginalName());
            $imageCompensation = $file->getClientOriginalName();
        }      
        $order = order::find($id);
        $order->imageCompensation = $imageCompensation;

        $order->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
        }

        public function updateOrderData(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->dateline = $request->get('dateline');     
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }

        public function updateOrderComfirm(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->stepStatusID = $request->get('stepStatusID');     
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }

        public function updateOrderCancel(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->stepStatusID = $request->get('stepStatusID');     
            $order->text_alert = $request->get('text_alert');  
            $order->text_alertStatus = $request->get('text_alertStatus');  
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }
        public function updateOrderCancelCusMoney(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->stepStatusID = $request->get('stepStatusID');     
            $order->overdueMoney = $request->get('overdueMoney');  
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }
        public function updateOrderCancelEmp(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->stepStatusID = $request->get('stepStatusID');     
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }

        public function updateOrderText_alertStatus(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->text_alertStatus = $request->get('text_alertStatus');  
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }

        public function updateDateline(Request $request, $id)
        {       
            date_default_timezone_set('Asia/Bangkok');
    
    
            $order = order::find($id);
            $order->overdueMoney = $request->get('overdueMoney');     
            $order->dateline = $request->get('dateline');     
            $order->text_alert = $request->get('text_alert');
            $order->text_alertStatus = $request->get('text_alertStatus');  
    
            $order->save();
    
            return response()->json(array(
                'message' => 'update a order successfully', 
                'status' => 'true'));
        }

        public function viewOrderStepStatusIDWaitingASC($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            WHERE orders.stepStatusID = $id
            ORDER BY orders.created_at ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function viewOrderStepStatusIDWaitingASCType3()
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN salary ON orders.orderID = salary.orderID
            WHERE salary.empID = 0 AND salary.orderDetailID != 0
            ORDER BY orders.created_at ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        

        public function viewOrderDESC(Request $request)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders ORDER BY orders.orderID DESC";
            $products=DB::select($sql)[0];         
            return response()->json($products);
        }

        public function viewOrderDateline(Request $request)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders ORDER BY orders.orderID DESC";
            $products=DB::select($sql)[0];         
            return response()->json($products);
        }

        public function viewOrderStepStatusASC(Request $request)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN members ON orders.memberID = members.memberID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            WHERE orders.stepStatusID != 99 AND orders.stepStatusID != 14 AND orders.stepStatusID != 15
            ORDER BY orders.stepStatusID ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function viewOrderStepStatusPayASC(Request $request)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN members ON orders.memberID = members.memberID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            WHERE orders.stepStatusID != 0 AND orders.stepStatusID != 1 AND orders.stepStatusID != 2 AND orders.stepStatusID != 3
            AND orders.stepStatusID != 4 AND orders.stepStatusID != 5 AND orders.stepStatusID != 6 AND orders.stepStatusID != 7
            AND orders.stepStatusID != 8 AND orders.stepStatusID != 9 AND orders.stepStatusID != 10 AND orders.stepStatusID != 11
            AND orders.stepStatusID != 12 AND orders.stepStatusID != 13 AND orders.stepStatusID != 15 AND orders.stepStatusID != 99
            ORDER BY orders.stepStatusID ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function viewOrderUserStepStatusASC($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN members ON orders.memberID = members.memberID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            WHERE orders.memberID = $id AND orders.stepStatusID = 0 OR orders.memberID = $id AND orders.stepStatusID = 1 OR orders.memberID = $id AND orders.stepStatusID = 2
            OR orders.memberID = $id AND orders.stepStatusID = 3 OR orders.memberID = $id AND orders.stepStatusID = 4 OR orders.memberID = $id AND orders.stepStatusID = 5 
            OR orders.memberID = $id AND orders.stepStatusID = 6 OR orders.memberID = $id AND orders.stepStatusID = 7 OR orders.memberID = $id AND orders.stepStatusID = 8 
            OR orders.memberID = $id AND orders.stepStatusID = 9 OR orders.memberID = $id AND orders.stepStatusID = 10 OR orders.memberID = $id AND orders.stepStatusID = 11 
            OR orders.memberID = $id AND orders.stepStatusID = 12 OR orders.memberID = $id AND orders.stepStatusID = 14 OR orders.memberID = $id AND orders.stepStatusID = 15 OR orders.memberID = $id AND orders.stepStatusID = 99
            ORDER BY orders.stepStatusID ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function viewOrderUserStepStatusPayASC($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN members ON orders.memberID = members.memberID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            WHERE orders.stepStatusID = 13 AND orders.memberID = $id
            ORDER BY orders.stepStatusID ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }

        public function viewOrderEmpStepStatusASC($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders 
            INNER JOIN members ON orders.memberID = members.memberID
            INNER JOIN stepStatus ON orders.stepStatusID = stepStatus.stepStatusID
            INNER JOIN salary ON orders.orderID = salary.orderID ";

            if($id1 == "1"){
                $sql .="WHERE salary.empID=$id2 AND orders.stepStatusID = 2 AND salary.statusOrder != 2
                        OR salary.empID=$id2 AND orders.stepStatusID = 3 AND salary.statusOrder != 2 ";
                }else if($id1 == "2"){
                    $sql .="WHERE salary.empID=$id2 AND orders.stepStatusID = 5 AND salary.statusOrder != 2
                            OR salary.empID=$id2 AND orders.stepStatusID = 6 AND salary.statusOrder != 2 ";
                }else if($id1 == "3"){
                    $sql .="WHERE salary.empID=$id2 AND orders.stepStatusID = 8 AND salary.statusOrder != 2 
                            OR salary.empID=$id2 AND orders.stepStatusID = 9 AND salary.statusOrder != 2 ";
                }else if($id1 == "4"){
                    $sql .="WHERE salary.empID=$id2 AND orders.stepStatusID = 11 AND salary.statusOrder != 2 
                            OR salary.empID=$id2 AND orders.stepStatusID = 12 AND salary.statusOrder != 2 ";
                }

                $sql .="ORDER BY salary.created_at ASC";
            $products=DB::select($sql);         
            return response()->json($products);
        }
        

        public function viewOrderUser($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN materials ON order_details.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE orders.memberID=$id";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewOrderIDOneUser($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders
            INNER JOIN members ON orders.memberID = members.memberID
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        

        public function viewOrderText_alert($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders
            WHERE orders.memberID=$id AND text_alertStatus = 1";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function SUMOrderpriceTotal($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT SUM(order_details.priceTotal) AS TotalAllPrice,SUM(order_details.quanTotal) AS TotalAllQuan,SUM(order_details.priceTotal)/2 AS HalfPrice FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            WHERE orders.memberID=$id1 AND orders.orderID=$id2";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        public function ViewSoldProductID($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT products.productID,(products.productSold+order_details.quanTotal) AS quanTotal,(products.productSoldMoney+order_details.priceTotal) AS priceTotal FROM orders 
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            WHERE  orders.orderID=$id";
            $shop_cart=DB::select($sql);        

            return response()->json($shop_cart);
        }


        public function viewONEOrderUserProductID($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT order_details.productID,products.productImage,product_types.typeName,
            SUM(order_details.quanSizeF),SUM(order_details.quanSizeS),SUM(order_details.quanSizeM),
            SUM(order_details.quanSizeL),SUM(order_details.quanSizeXL),SUM(order_details.quanSize2XL),
            SUM(order_details.quanSize3XL),SUM(order_details.quanTotal),orders.orderID,product_types.patternRate,products.productName FROM orders 
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE orders.memberID=$id1 AND orders.orderID=$id2
            GROUP BY order_details.productID,products.productImage,product_types.typeName,orders.orderID,product_types.patternRate,products.productName";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewOrderUserColorGROUP($id1,$id2,$id3)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT materials.materialColor,order_details.quanTotal,
                        order_details.quanSizeF,order_details.quanSizeS,order_details.quanSizeM,order_details.quanSizeL,
                        order_details.quanSizeXL,order_details.quanSize2XL,order_details.quanSize3XL
                        FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN materials ON order_details.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE orders.memberID=$id1 AND order_details.productID=$id2 AND orders.orderID=$id3
            GROUP BY order_details.orderDetailID,order_details.productID,materials.materialColor,order_details.quanTotal,
                        order_details.quanSizeF,order_details.quanSizeS,order_details.quanSizeM,order_details.quanSizeL,
                        order_details.quanSizeXL,order_details.quanSize2XL,order_details.quanSize3XL";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function OrderQuanUsed($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT order_details.orderDetailID,(order_details.quanSizeF*product_types.sizeRateF) +
                        (order_details.quanSizeS*product_types.sizeRateS) + 
                        (order_details.quanSizeM*product_types.sizeRateM) +
                        (order_details.quanSizeL*product_types.sizeRateL) +
                        (order_details.quanSizeXL*product_types.sizeRateXL) +
                        (order_details.quanSize2XL*product_types.sizeRate2XL) +
                        (order_details.quanSize3XL*product_types.sizeRate3XL) AS MaterialsQuanUsed,
                        order_details.materialID FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN materials ON order_details.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE orders.memberID=$id1 AND orders.orderID=$id2
            GROUP BY order_details.orderDetailID,order_details.quanSizeF,product_types.sizeRateF,
            order_details.quanSizeS,product_types.sizeRateS,order_details.quanSizeM,product_types.sizeRateM,
            order_details.quanSizeL,product_types.sizeRateL,order_details.quanSizeXL,product_types.sizeRateXL,
            order_details.quanSize2XL,product_types.sizeRate2XL,order_details.quanSize3XL,product_types.sizeRate3XL,
            order_details.materialID,materials.materialSize";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function OrderQuanUsedSp($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT order_details.orderDetailID,(order_details.quanTotal*choose_mat_sp.quanRate) AS Materials_SpQuanUsed,choose_mat_sp.material_spID FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN products ON order_details.productID = products.productID
            INNER JOIN choose_mat_sp ON products.productID = choose_mat_sp.productID 
            WHERE orders.memberID=$id1 AND orders.orderID=$id2
            GROUP BY order_details.orderDetailID,order_details.quanTotal,choose_mat_sp.quanRate,choose_mat_sp.material_spID";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function OrderCutRate($id1,$id2)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT order_details.materialID,materials.cutRate FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            INNER JOIN materials ON order_details.materialID = materials.materialID
            WHERE orders.memberID=$id1 AND orders.orderID=$id2
            GROUP BY order_details.materialID,materials.cutRate";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function ViewStepStatus($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT * FROM orders
            INNER JOIN stepstatus ON orders.stepStatusID = stepstatus.stepStatusID
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        public function ViewOrderCreated_at($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT SUBSTRING(orders.created_at,1,10) FROM orders
            WHERE orders.orderID=$id
            GROUP BY SUBSTRING(orders.created_at,1,10)";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        public function SUMpriceTotalOrder($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            $sql="SELECT SUM(order_details.priceTotal) AS TotalAllPrice,SUM(order_details.quanTotal) AS TotalAllQuan,SUM(order_details.priceTotal/2) AS HalfPrice FROM orders
            INNER JOIN order_details ON orders.orderID = order_details.orderID
            WHERE orders.orderID=$id";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }



}