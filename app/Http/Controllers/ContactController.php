<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function store(Request $request){
        try {
            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->route('customer.contact')->withErrors('success','Send Contact Successfully');
        }catch (Exception $e){
            return redirect()->route('customer.contact')->withErrors('error','Error Send Contact');
        }
    }
}
