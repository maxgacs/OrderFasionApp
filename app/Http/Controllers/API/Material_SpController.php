<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\material_sp;
use DB;

class Material_SpController extends Controller
{
    
    public function viewMaterial_Sp($id)
    {
        $sql="SELECT * FROM material_sps
            WHERE material_sps.material_spID=$id";
        $main_product=DB::select($sql)[0];         
        return response()->json($main_product);
    }

    public function updateMaterial_SpSize(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');


        $material = material_sp::find($id);
        $material->material_spQuan = $request->get('material_spQuan');     

        $material->save();

        return response()->json(array(
            'message' => 'update a material_spQuan successfully', 
            'status' => 'true'));
    }


}