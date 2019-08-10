<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create(){
        return view('Contact.contactForm');
    }
    public function store(Request $request){
        $data=$request->validate($this->rules());
        Mail::to('test@test.z')->send(new ContactMail($data));
        return back();


    }
    private function rules(){
        return[
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required|min:8'
        ];
    }

}
