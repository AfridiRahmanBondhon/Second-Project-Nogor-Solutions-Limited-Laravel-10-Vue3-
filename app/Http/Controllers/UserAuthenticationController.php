<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAuthentication;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserAuthenticationController extends Controller
{
    private $u;

    public function registration(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:191|min:3',
            'email'=>'required|email|max:191',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=>202,
                'message'=>$validator->messages(),
            ],202);
        }
        else{
            $u= UserAuthentication::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            if ($u){
                return response()->json([
                    'status'=>200,
                    'message'=>"User Created Successfully"
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Something went wrong"
                ],500);
            }
        }
    }
    public function match(Request $request){
        //dd($request->password);
        $u = UserAuthentication::where('email',$request->email)->first();
        //dd($u->password);
        if ($u){
            if (Hash::check($request->password, $u->password)){
                
                Session::put('user_id',$u->id);

                if($u){
                    $data = ['userId' =>  $u->id];
                    $jsonData = json_encode($data);
                    $filePath = public_path('tmp.json');
                    file_put_contents($filePath, $jsonData);
                }
                return response()->json([
                    'status'=>200,
                    'forms'=>$u,
                    'conformation'=>"ok"
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>"No Such Data Found",
                    'conformation'=>"not ok"
                ],404);
            }
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"Something went wrong",
            ],500);
        }
    }
    public function logout(){
        //Session::forget('user_id');

        $filePath = public_path('tmp.json');

        if(File::isFile($filePath)){
            File::delete($filePath);
        }

        return response()->json([
            'status'=>200,
            'message'=>"Log Out Successful",
        ],200);
    }
    public function userData(){
        $u = UserAuthentication::all();
        //return $u;
        if($u->count()>0){
            return response()->json([
                'status'=>200,
                'datas'=>$u,
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'datas'=>'No Data Found',
            ],404);
        }
    }
    public function destroy($id){
        $u = UserAuthentication::find($id);
        if ($u){
            $u->forceDelete();
            return response()->json([
                'status'=>200,
                'message'=>"Data Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"No Such Data Found!"
            ],500);
        }
    }
}
