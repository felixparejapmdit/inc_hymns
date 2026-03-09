<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrumentation; // Replace with relevant model
use App\Helpers\ActivityLogHelper;

class InstrumentationController extends Controller
{
    // Display a listing of the instrumentations
    public function index()
    {
  
        $instrumentations = Instrumentation::paginate(15);
        return view('music_management/instrumentations', compact('instrumentations'));
    }

    // Show the form for creating a new instrumentation
    public function create()
    {
        return view('instrumentations.create');
    }

    // Store a newly created instrumentation in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $instrumentation = Instrumentation::create($validatedData);
        
        ActivityLogHelper::log('created', $instrumentation->name, $instrumentation->id, 'add new instrumentation');

        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation created successfully!');
    }

    // Display the specified instrumentation
    public function show(Instrumentation $instrumentation)
    {
        return view('instrumentations.show', compact('instrumentation'));
    }

    // Show the form for editing the specified instrumentation
    public function edit(Instrumentation $instrumentation)
    {
        return view('instrumentations.edit', compact('instrumentation'));
    }

    // Update the specified instrumentation in the database
    public function update(Request $request, Instrumentation $instrumentation)
    {
        $validatedData = $request->validate([
            'edit_name' => 'required|max:255',
        ]);

        $instrumentation->update([
            'name' => $request->edit_name,
        ]);

        ActivityLogHelper::log('updated', $instrumentation->name, $instrumentation->id,  'update the instrumentation');

        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation updated successfully!');
    }

    // Delete the specified instrumentation from the database
    public function destroy(Instrumentation $instrumentation)
    {
        $instrumentation->delete();


        ActivityLogHelper::log('deleted', $instrumentation->name, $instrumentation->id,  'delete the instrumentation');

        return redirect()->route('instrumentations.index')->with('success', 'Instrumentation deleted successfully!');
    }
}
