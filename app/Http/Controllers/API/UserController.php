<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\member;
use DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $memberUsername = $request->get('memberUsername');
        $memberPassword = sha1($request->get('memberPassword'));
        $users = member::login($memberUsername,$memberPassword);
        
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

    public function createUser(Request $request)
    {
    
        date_default_timezone_set('Asia/Bangkok');

        $image = "test.jpg";
        $members = new member();
        $members->memberName = $request->get('memberName');     
        $members->memberStoreName = $request->get('memberStoreName');
        $members->memberUsername = $request->get('memberUsername');
        $members->memberPassword = sha1($request->get('memberPassword'));
        $members->memberAddress = $request->get('memberAddress');    
        $members->memberPhone = $request->get('memberPhone');
        $members->memberGender = $request->get('memberGender');
        $members->memberEmail = $request->get('memberEmail');
        $members->memberImage = $image;

        //$users->walletID = $wallet->walletID;

        $members->save();                
        return response()->json(array(
            'message' => 'add a user successfully', 
            'status' => 'true'));  

    }
        
    public function viewUsers(Request $request)
    {
        $sql="SELECT * FROM members";
        $user=DB::select($sql);         
        return response()->json($user);
    }

    public function viewOneUser($id)
    {
        $sql="SELECT * FROM members 
               WHERE members.memberID=$id";
        $user=DB::select($sql)[0];         
        return response()->json($user);
    }

    
    public function updateUsers(Request $request, $id)
    {       
        date_default_timezone_set('Asia/Bangkok');


        $members = member::find($id);
        $members->memberName = $request->get('memberName');     
        $members->memberStoreName = $request->get('memberStoreName');
        $members->memberAddress = $request->get('memberAddress');    
        $members->memberPhone = $request->get('memberPhone');
        $members->memberGender = $request->get('memberGender');
        $members->memberEmail = $request->get('memberEmail');

        $members->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }

    public function updateImageUser(Request $request, $id)
    {
        date_default_timezone_set('Asia/Bangkok');

        //validate file uploading,  where image works for jpeg, png, bmp, gif, or svg
        $this->validate($request, ['file' => 'image']);


        $file = $request->file('file');
        $imageFileName = "";
        if(isset($file)){
            $file->move('assets/uploadfile/user',$file->getClientOriginalName());
            $imageFileName = $file->getClientOriginalName();
        }      
        $members = member::find($id);
        $members->imageFileName = $imageFileName;

        $members->save();

        return response()->json(array(
            'message' => 'update a user successfully', 
            'status' => 'true'));
    }

    

}