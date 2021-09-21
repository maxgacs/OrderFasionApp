<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\material;
use DB;

class MaterialController extends Controller
{
    
    public function viewMaterial($id)
    {
        $sql="SELECT * FROM materials
            WHERE materials.materialID=$id";
        $main_product=DB::select($sql)[0];         
        return response()->json($main_product);
    }

    public function updateMaterialSize(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');


        $material = material::find($id);
        $material->materialSize = $request->get('materialSize');     

        $material->save();

        return response()->json(array(
            'message' => 'update a materialSize successfully', 
            'status' => 'true'));
    }


}