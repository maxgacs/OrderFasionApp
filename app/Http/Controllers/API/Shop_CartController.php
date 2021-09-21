<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shop_cart;
use App\Models\material;
use App\Models\material_sp;
use DB;

class Shop_CartController extends Controller
{
    
    public function AddCart(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

        $shop_cart = new shop_cart();
        $shop_cart->priceTotal = $request->get('priceTotal');     
        $shop_cart->priceSizeF = $request->get('priceSizeF');
        $shop_cart->priceSizeS = $request->get('priceSizeS');
        $shop_cart->priceSizeM = $request->get('priceSizeM');
        $shop_cart->priceSizeL = $request->get('priceSizeL');    
        $shop_cart->priceSizeXL = $request->get('priceSizeXL');
        $shop_cart->priceSize2XL = $request->get('priceSize2XL');
        $shop_cart->priceSize3XL = $request->get('priceSize3XL');
        $shop_cart->quanTotal = $request->get('quanTotal');     
        $shop_cart->quanSizeF = $request->get('quanSizeF');
        $shop_cart->quanSizeS = $request->get('quanSizeS');
        $shop_cart->quanSizeM = $request->get('quanSizeM');
        $shop_cart->quanSizeL = $request->get('quanSizeL');    
        $shop_cart->quanSizeXL = $request->get('quanSizeXL');
        $shop_cart->quanSize2XL = $request->get('quanSize2XL');
        $shop_cart->quanSize3XL = $request->get('quanSize3XL');
        $shop_cart->productID = $request->get('productID');
        $shop_cart->memberID = $request->get('memberID');
        $shop_cart->materialID = $request->get('materialID');

        //$users->walletID = $wallet->walletID;

        $shop_cart->save();                
        return response()->json(array(
            'message' => 'add a shop_cart successfully', 
            'status' => 'true'));  
        }

        public function viewCartUser($id)
        {
            $sql="SELECT * FROM shop_carts
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN materials ON shop_carts.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE shop_carts.memberID=$id";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }


        public function cartdelete($id)
        {
            date_default_timezone_set('Asia/Bangkok');
    
        $sql="DELETE FROM `shop_carts`
        WHERE shop_carts.shopCartID=$id";
        
        $cart=DB::delete($sql);         
        return response()->json($cart);
        }

        public function SUMpriceTotal($id)
        {
            $sql="SELECT SUM(priceTotal) AS TotalAllPrice,SUM(quanTotal) AS TotalAllQuan,SUM(priceTotal/2) AS HalfPrice FROM shop_carts
            WHERE shop_carts.memberID=$id";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        public function SUMdataTotal($id)
        {
            $sql="SELECT shop_carts.materialID,SUM(quanTotal) AS TotalAllQuan FROM shop_carts
            WHERE shop_carts.memberID=$id
            GROUP BY shop_carts.materialID";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function QuanUsed($id)
        {
            date_default_timezone_set('Asia/Bangkok');

            $sql="SELECT shop_carts.shopCartID,(shop_carts.quanSizeF*product_types.sizeRateF) +
                        (shop_carts.quanSizeS*product_types.sizeRateS) + 
                        (shop_carts.quanSizeM*product_types.sizeRateM) + 
                        (shop_carts.quanSizeL*product_types.sizeRateL) + 
                        (shop_carts.quanSizeXL*product_types.sizeRateXL) + 
                        (shop_carts.quanSize2XL*product_types.sizeRate2XL) + 
                        (shop_carts.quanSize3XL*product_types.sizeRate3XL) AS MaterialsQuanUsed,
                        shop_carts.materialID FROM shop_carts
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN materials ON shop_carts.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE shop_carts.memberID=$id
            GROUP BY shop_carts.shopCartID,shop_carts.quanSizeF,product_types.sizeRateF,shop_carts.quanSizeS,product_types.sizeRateS,
            shop_carts.quanSizeM,product_types.sizeRateM,shop_carts.quanSizeL,product_types.sizeRateL,
            shop_carts.quanSizeXL,product_types.sizeRateXL,shop_carts.quanSize2XL,product_types.sizeRate2XL,
            shop_carts.quanSize3XL,product_types.sizeRate3XL,shop_carts.quanSize3XL,product_types.sizeRate3XL,
            shop_carts.materialID,materials.materialSize";
            $shop_cart=DB::select($sql);         




            return response()->json($shop_cart);
        }

        public function QuanUsedSp($id)
        {
            date_default_timezone_set('Asia/Bangkok');
            
            $sql="SELECT shop_carts.shopCartID,(shop_carts.quanTotal*choose_mat_sp.quanRate) AS Materials_SpQuanUsed,choose_mat_sp.material_spID FROM shop_carts
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN choose_mat_sp ON products.productID = choose_mat_sp.productID 
            INNER JOIN material_sps ON choose_mat_sp.material_spID = material_sps.material_spID 
            WHERE shop_carts.memberID=$id
            GROUP BY shop_carts.shopCartID,shop_carts.quanTotal,choose_mat_sp.quanRate,choose_mat_sp.material_spID,material_sps.material_spQuan";
            $shop_cart=DB::select($sql);      
            

            return response()->json($shop_cart);
        }
        
        public function HalfpriceTotal($id)
        {
            $sql="SELECT SUM(priceTotal)/2 AS TotalAllPrice FROM shop_carts
            WHERE shop_carts.memberID=$id";
            $shop_cart=DB::select($sql)[0];         
            return response()->json($shop_cart);
        }

        public function viewCartUserColorGROUP($id1,$id2)
        {
            $sql="SELECT materials.materialColor,shop_carts.quanTotal,
                        shop_carts.quanSizeF,shop_carts.quanSizeS,shop_carts.quanSizeM,shop_carts.quanSizeL,
                        shop_carts.quanSizeXL,shop_carts.quanSize2XL,shop_carts.quanSize3XL
                        FROM shop_carts
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN materials ON shop_carts.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE shop_carts.memberID=$id1 AND shop_carts.productID=$id2
            GROUP BY shop_carts.shopCartID,shop_carts.productID,materials.materialColor,shop_carts.quanTotal,
                        shop_carts.quanSizeF,shop_carts.quanSizeS,shop_carts.quanSizeM,shop_carts.quanSizeL,
                        shop_carts.quanSizeXL,shop_carts.quanSize2XL,shop_carts.quanSize3XL";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewONECartUserProductID($id)
        {
            $sql="SELECT shop_carts.productID,products.productImage,product_types.typeName,products.productName,
            SUM(shop_carts.quanSizeF),SUM(shop_carts.quanSizeS),SUM(shop_carts.quanSizeM),
            SUM(shop_carts.quanSizeL),SUM(shop_carts.quanSizeXL),SUM(shop_carts.quanSize2XL),
            SUM(shop_carts.quanSize3XL),SUM(shop_carts.quanTotal) FROM shop_carts 
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE shop_carts.memberID=$id
            GROUP BY shop_carts.productID,products.productImage,product_types.typeName,products.productName";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewProductCartUser($id1,$id2)
        {
            $sql="SELECT * FROM shop_carts
            INNER JOIN products ON shop_carts.productID = products.productID
            INNER JOIN materials ON shop_carts.materialID = materials.materialID 
            INNER JOIN product_types ON products.productTypeID = product_types.productTypeID 
            WHERE shop_carts.memberID=$id1 AND shop_carts.productID=$id2";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        public function viewMaterialID($id)
        {
            $sql="SELECT shop_carts.materialID,(SUM(shop_carts.quanTotal)/24)+1 FROM shop_carts
            WHERE shop_carts.memberID=$id
            GROUP BY shop_carts.materialID";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

        
        public function viewCart($id)
        {
            $sql="SELECT * FROM shop_carts
            WHERE shop_carts.memberID=$id";
            $shop_cart=DB::select($sql);         
            return response()->json($shop_cart);
        }

    
}