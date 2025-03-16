<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    /*public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $validated = $request->validated();
        return view('confirm', compact('validated'));
    }*/

    public function confirm(ContactRequest $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone1' => 'required',
            'phone2' => 'required',
            'phone3' => 'required',
            'address' => 'required',
            'building' => 'nullable',
            'inquiry_type' => 'required',
            'detail' => 'required|max:120',
        ]);

        return view('confirm', $validatedData);
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return response()->json([
            'name' => $contact->last_name . ' ' . $contact->first_name,
            'gender' => $this->getGenderText($contact->gender),
            'email' => $contact->email,
            'phone' => $contact->phone1 . '-' . $contact->phone2 . '-' . $contact->phone3,
            'address' => $contact->address,
            'building' => $contact->building,
            'inquiry_type' => $this->getInquiryTypeText($contact->inquiry_type),
            'detail' => $contact->detail,
        ]);
    }

    private function getGenderText($gender)
    {
        switch ($gender) {
            case '1':
                return '男性';
            case '2':
                return '女性';
            case '3':
                return 'その他';
        }
    }

    private function getInquiryTypeText($type)
    {
        switch ($type) {
            case '1':
                return '商品のお届けについて';
            case '2':
                return '商品交換について';
            case '3':
                return '商品トラブル';
            case '4':
                return 'ショップへのお問い合わせ';
            case '5':
                return 'その他';
        }
    }
}
