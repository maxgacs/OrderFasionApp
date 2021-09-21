<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use DB;

class ProductController extends Controller
{
    
    public function viewProduct(Request $request)
    {
        $sql="SELECT * FROM products";
        $products=DB::select($sql);         
        return response()->json($products);
    }

    public function viewProductType($id)
    {
        $sql="SELECT * FROM products
        INNER JOIN product_types ON products.productTypeID = product_types.productTypeID
        INNER JOIN main_product_types ON products.mainProductTypeID = main_product_types.mainProductTypeID
        WHERE main_product_types.mainProductTypeID=$id";
        $products=DB::select($sql);         


        return response()->json($products);
    }
    public function viewProductOne($id)
    {
        $sql="SELECT * FROM products
        WHERE products.productID=$id";
        $products=DB::select($sql)[0];         
        return response()->json($products);
    }

    public function updateProduct(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');

        $product = product::find($id);
        $product-> productSold = $request->get('productSold');     
        $product-> productSoldMoney = $request->get('productSoldMoney');       
        $product->save();

        return response()->json(array(
            'message' => 'update a order successfully', 
            'status' => 'true'));
    }

    

   

}