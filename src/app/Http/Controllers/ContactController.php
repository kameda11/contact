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
        $contact = $request->all(); // すべてのデータを取得

        return view('confirm', [
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
        ]);
        return view('confirm', ['contact' => $contact]);
    }

    public function thanks(ContactRequest $request)
    {
        $contact = $request->only(['first_name','last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'inquiry_type', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
}
