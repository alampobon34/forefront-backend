<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    public function addContact(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:5',
        ]);

        if($validator-> fails())
        {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        }

        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->save();
        return response()->json([
            'status' => 200,
            'success' => 'Contact Added Successfully!!',
        ]);



    }

    public function getAllContactData(){
        $contact = Contact::all();
        return response()->json([
            'status'=>200,
            'contact_data'=>$contact,
        ]);
    }
}
