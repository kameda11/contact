<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Contact;

class CategoryController extends Controller
{
    public function admin(Request $request)
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

        $contacts = $query->paginate(7);

        $contacts->appends($request->all());

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));

    }
}
