<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class CsvExportController extends Controller
{
    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('content')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', $request->content)
                    ->orWhere('last_name', $request->content)
                    ->orWhere('email', $request->content)
                    ->orWhere('first_name', 'like', '%' . $request->content . '%')
                    ->orWhere('last_name', 'like', '%' . $request->content . '%')
                    ->orWhere('email', 'like', '%' . $request->content . '%');
            });
        }

        if ($request->filled('search_gender')) {
            $genderValue = null;
            switch ($request->search_gender) {
                case 'man':
                    $genderValue = '1';
                    break;
                case 'woman':
                    $genderValue = '2';
                    break;
                case 'others':
                    $genderValue = '3';
                    break;
            }

            if ($genderValue) {
                $query->where('gender', $genderValue);
            }
        }

        if ($request->filled('search_inquiry_type')) {
            $query->where('inquiry_type', $request->search_inquiry_type);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->with('category')->get();

        $fileName = 'contacts_export.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            'ID',
            'カテゴリ',
            '姓',
            '名',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせ種別',
            '詳細',
            '作成日時',
            '更新日時'
        ];

        $callback = function () use ($contacts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($contacts as $contact) {
                $gender = $this->getGenderText($contact->gender);
                $inquiryType = $this->getInquiryTypeText($contact->inquiry_type);

                $row = [
                    $contact->id,
                    $contact->category->name,
                    $contact->last_name,
                    $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->phone1 . '-' . $contact->phone2 . '-' . $contact->phone3,
                    $contact->address,
                    $contact->building,
                    $inquiryType,
                    $contact->detail,
                    $contact->created_at,
                    $contact->updated_at
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getGenderText($gender)
    {
        $genders = ['1' => '男性', '2' => '女性', '3' => 'その他'];
        return $genders[$gender] ?? '不明';
    }

    private function getInquiryTypeText($inquiryType)
    {
        $types = [
            '1' => '商品のお届けについて',
            '2' => '商品交換について',
            '3' => '商品トラブル',
            '4' => 'ショップへのお問い合わせ',
            '5' => 'その他'
        ];
        return $types[$inquiryType] ?? '不明';
    }
}
