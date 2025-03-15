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
            $query->where('first_name', 'like', '%' . $request->content . '%')
                ->orWhere('last_name', 'like', '%' . $request->content . '%')
                ->orWhere('email', 'like', '%' . $request->content . '%');
        }

        if ($request->filled('search_gender')) {
            $query->where('gender', $request->search_gender);
        }

        if ($request->filled('search_inquiry_type')) {
            $query->where('inquiry_type', $request->search_inquiry_type);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->get();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
