<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $data = $request->all();
        return view('confirm', compact('data'));
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('thanks')->with('success', 'お問い合わせが送信されました。');
    }

    public function thanks(ContactRequest $request)
    {
        $data = $request->validated();
        $data['category_id'] = 1;

        Contact::create($data);
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

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if ($contact) {
            $contact->delete();
            return response()->json(['message' => '削除されました']);
        } else {
            return response()->json(['message' => 'データが見つかりません'], 404);
        }
    }
}
