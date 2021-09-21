<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class ManagerController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->get('username');
        $passwordApp = sha1($request->get('passwordApp'));
        $users = User::login($username,$passwordApp);
        
        if($users){
            $user = (array)$users;
            $user['message'] = 'success';
            $user['status'] = 'true';    
            //$user['token'] = sha1($username . $password . "@%#XYaU12$");        
        }else{
            $user = array(
                'message' => 'this user is not found', 
                'status' => 'false');
        }

        return response()->json($user);
    }

    public function viewOneManager($id)
    {
        $sql="SELECT * FROM manager 
               WHERE manager.userID=$id";
        $user=DB::select($sql)[0];         
        return response()->json($user);
    }

}