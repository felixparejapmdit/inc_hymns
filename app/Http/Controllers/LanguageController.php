<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

use App\Helpers\ActivityLogHelper;

class LanguageController extends Controller
{
    // Display a listing of the languages
    public function index()
    {
        $languages = Language::orderBy('name')
            ->paginate(10)
            ->withQueryString();
        return view('languages.index', compact('languages'));
    }

    // Store a newly created language in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $language = Language::create($validatedData);

        ActivityLogHelper::log('created', $language->name, $language->id, 'add new language');
    

        return redirect()->route('languages.index')->with('success', 'Language created successfully!');
    }

    // Update the specified language in the database
    public function update(Request $request, Language $language)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $language->update($validatedData);


        ActivityLogHelper::log('updated', $language->name, $language->id,  'update the language');

        return redirect()->route('languages.index')->with('success', 'Language updated successfully!');
    }

    // Delete the specified language from the database
    public function destroy(Language $language)
    {
        $language->delete();

        ActivityLogHelper::log('deleted', $language->name, $language->id,  'delete the language');
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully!');
    }
}
