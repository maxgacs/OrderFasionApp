<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bank;
use DB;

class bankController extends Controller
{
    
    public function viewbank(Request $request)
    {
        $sql="SELECT * FROM banks";
        $banks=DB::select($sql);         
        return response()->json($banks);
    }




}