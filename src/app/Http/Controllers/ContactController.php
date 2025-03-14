<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'inquiry_type', 'detail']);
        return view('confirm', ['contact' => $contact]);
    }

    public function thanks(ContactRequest $request)
    {
        $contact = $request->only(['first_name','last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'inquiry_type', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
}
