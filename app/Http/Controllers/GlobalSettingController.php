<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class GlobalSettingController extends Controller
{
    function getGlobalSettings(){
        $contact = Contact::first();
        return view('screen.setting.globalsetting',compact('contact'));
    }
    function getContact(){
        $contact = Contact::first();
        return $contact;
    }
}
