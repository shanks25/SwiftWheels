<?php

namespace App\Http\Controllers;

use App\Mail\mailtrap;
 
use Illuminate\Support\Facades\Mail;

  
class MailController extends Controller
{
 	public function index(){
 	
  	Mail::to('info@swift-wheels.com')->send(new mailtrap());

  	return redirect()->back()->with('message','Your Enquiry forwarded Successfully, We get back to you');
 		 
 	}
}
 