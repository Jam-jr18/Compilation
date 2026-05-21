<?php

namespace App\Http\Controllers;

use App\Models\Guitar;
use Illuminate\Http\Request;

class GuitarController extends Controller
{
    /**
     * Display a listing of the guitars.
     */
    public function index() 
    {
        $guitars = Guitar::all();
        return view('guitars.index', compact('guitars'));
    }

    /**
     * Show the form for creating a new guitar.
     */
    public function create() 
    {
        return view('guitars.create');
    }

    /**
     * Store a newly created guitar in database.
     */
    public function store(Request $request) 
    {
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type'  => 'required',
            'year'  => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        Guitar::create($data);

        return redirect()->route('guitars.index')
                         ->with('success', 'New guitar added to the collection!');
    }

    /**
     * Display the specified guitar details.
     */
    public function show($id) 
{
    $guitar = Guitar::findOrFail($id); // This finds the guitar or shows a 404 error
    return view('guitars.show', compact('guitar'));
}

    /**
     * Show the form for editing the specified guitar.
     */
    public function edit($id) 
    {
        $guitar = Guitar::findOrFail($id);
        return view('guitars.edit', compact('guitar'));
    }

    /**
     * Update the specified guitar in database.
     */
    public function update(Request $request, $id) 
    {
        // 1. Find the specific record
        $guitar = Guitar::findOrFail($id);

        // 2. Validate the incoming data
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type'  => 'required',
            'year'  => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
        ]);

        // 3. Update the database record
        $guitar->update($data);

        // 4. Redirect back to the index with a success message
        return redirect()->route('guitars.index')
                         ->with('success', 'Guitar records updated successfully!');
    }

    /**
     * Remove the specified guitar from database.
     */
    public function destroy($id) 
    {
        $guitar = Guitar::findOrFail($id);
        $guitar->delete();

        return redirect()->route('guitars.index')
                         ->with('success', 'Guitar removed from the records.');
    }
}