<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mainProductType;
use DB;

class MainProductController extends Controller
{
    
    public function viewMainProductType(Request $request)
    {
        $sql="SELECT * FROM main_product_types";
        $main_product=DB::select($sql);         
        return response()->json($main_product);
    }


}