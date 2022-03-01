<?php

namespace App\Http\Controllers;
use App\Models\JoinNow;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class JoinNowController extends Controller
{
    public function addJoinNow(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'CV_file' => 'required|mimes:pdf,docx',
        ]);

        if($validator-> fails())
        {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages(),
            ]);
        }
        
        $joinNow = new JoinNow;
        $joinNow->name = $request->input('name');
        $joinNow->email = $request->input('email');
        $joinNow->phone = $request->input('phone');
        // $joinNow->CV_file = $request->input('CV_file');
        if($request->hasFile('CV_file'))
        {
            $file = $request->file('CV_file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.'.$extension;
            $file->move('static/img/join-now',$fileName);
            $joinNow->CV_file = 'static/img/join-now/'.$fileName;
        }
        $joinNow->save();
        return response()->json([
            'status' => 200,
            'success' => 'Join Now Added Successfully!!',
        ]);
    }


    public function getAllJoinNowData(){
        $joinNow = JoinNow::all();
        return response()->json([
            'status'=>200,
            'joinNow_data'=>$joinNow,
        ]);
    }
}
