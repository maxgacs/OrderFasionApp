<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\choose_mat;
use DB;

class Choose_Mat_SpController extends Controller
{
    
    public function viewChoose_Mat_Sp($id)
    {
        $sql="SELECT * FROM choose_mat_sp
        INNER JOIN products ON products.productID = choose_mat_sp.productID
        INNER JOIN material_sps ON material_sps.material_spID = choose_mat_sp.material_spID
        WHERE products.productID=$id";
        $products=DB::select($sql);         
        return response()->json($products);
    }

    public function viewChoose_Mat_SpOne($id)
    {
        $sql="SELECT round(material_sps.material_spQuan/choose_mat_sp.quanRate,0) as checkSP FROM choose_mat_sp 
        INNER JOIN products ON products.productID = choose_mat_sp.productID
        INNER JOIN material_sps ON material_sps.material_spID = choose_mat_sp.material_spID
        WHERE products.productID=$id
        ORDER BY choose_mat_sp.quanRate DESC";
        $products=DB::select($sql)[0];         
        return response()->json($products);
    }




}