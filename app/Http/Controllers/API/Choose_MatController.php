<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\choose_mat;
use DB;

class Choose_MatController extends Controller
{
    
    public function viewChoose_Mat($id)
    {

        $sql="SELECT choose_mat.choose_matID,materials.materialID,materials.materialColor,materials.materialSize FROM choose_mat
        INNER JOIN products ON products.productID = choose_mat.productID
        INNER JOIN product_types ON product_types.productTypeID = products.productTypeID
        INNER JOIN materials ON materials.materialID = choose_mat.materialID
        WHERE products.productID=$id
        GROUP BY choose_mat.choose_matID,materials.materialID,materials.materialColor,materials.materialSize";
        $products=DB::select($sql);         
        return response()->json($products);
    }

    public function viewChoose_MatCOUNT($id)
    {
        $sql="SELECT COUNT(*) FROM choose_mat
        WHERE choose_mat.productID=$id";
        $products=DB::select($sql)[0];         
        return response()->json($products);
    }

    public function viewChoose_Mat_materialTypeName($id)
    {
        $sql="SELECT material_types.materialTypeName FROM choose_mat
        INNER JOIN products ON products.productID = choose_mat.productID
        INNER JOIN materials ON materials.materialID = choose_mat.materialID
        INNER JOIN material_types ON material_types.materialTypeID = materials.materialTypeID
        WHERE choose_mat.productID=$id";
        $products=DB::select($sql)[0];         
        return response()->json($products);
    }

    public function viewChoose_MatOne($id1,$id2)
    {
        $sql="SELECT * FROM choose_mat
        INNER JOIN products ON products.productID = choose_mat.productID   
        INNER JOIN product_types ON product_types.productTypeID = products.productTypeID
        INNER JOIN materials ON materials.materialID = choose_mat.materialID
        WHERE products.productID=$id1 AND materials.materialID=$id2";

        $products=DB::select($sql);         
        return response()->json($products);
    }



}