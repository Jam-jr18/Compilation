<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookFormController extends Controller
{
    public function create()
    {
        return view('book-form');
    }

    public function store(Request $request)
    {
        // 3. Validation Logic (30 pts)
        $validated = $request->validate([
            'borrower_name' => 'required|string|min:5|max:100',
            'book_title'    => 'required|min:2',
            'isbn'          => 'required|numeric|digits:13', // Specific rule
            'borrow_days'   => 'required|numeric|min:1|max:14',
            'membership'    => 'required|in:student,faculty,guest',
            'notes'         => 'nullable|string|max:250',
        ]);

        // Bonus: Success message and redirect
        return back()->with('success', 'Your book request has been submitted successfully!');
    }
}
