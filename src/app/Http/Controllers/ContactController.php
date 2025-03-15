<?php

namespace App\Http\Controllers;

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
        //*$contact = $request->all();

        /*return view('confirm', [
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'phone1' => $contact['phone1'],
            'phone2' => $contact['phone2'],
            'phone3' => $contact['phone3'],
            'address' => $contact['address'],
            'building' => $contact['building'],
            'inquiry_type' => $contact['inquiry_type'],
            'detail' => $contact['detail']
        ]);*/
        $contact = $request->validated();

        return view('confirm', $contact);
    }

    public function thanks()
    {
        return view('thanks');
    }
}
