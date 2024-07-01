<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicCreator;

use App\Helpers\ActivityLogHelper;

class MusicCreatorController extends Controller
{
// Display a listing of the music creators with search functionality
public function index(Request $request)
{
    $query = $request->input('query');
    
    // If a search query is provided, filter the records
    if ($query) {
        $credits = MusicCreator::where('name', 'like', '%'. $query. '%')
            ->orWhere('district', 'like', '%'. $query. '%')
            ->orWhere('local', 'like', '%'. $query. '%')
            ->orWhere('music_background', 'like', '%'. $query. '%')
            ->orWhere('designation', 'like', '%'. $query. '%')
            ->orderBy('name', 'asc') // Add this line to sort by name in ascending order
            ->paginate(15)
            ->withQueryString(); // Include query string in pagination links
    } else {
        // If no search query is provided, fetch all records
        $credits = MusicCreator::orderBy('name', 'asc') // Add this line to sort by name in ascending order
            ->paginate(15);
    }
    
    return view('music_management/credits', compact('credits'));
}


    // Show the form for creating a new music creator
    public function create()
    {
        return view('credits.create');
    }

    // Store a newly created music creator in the database
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'local' => 'nullable|string',
            'district' => 'nullable|string',
            'duty' => 'nullable|string',
            'birthday' => 'nullable|date',
            'music_background' => 'nullable|string',
            'add_designation' => 'required|integer',
        ]);
       
         // Rename the 'add_designation' key to 'designation'
        $validatedData['designation'] = $validatedData['add_designation'];
        unset($validatedData['add_designation']);
   
        // Create new music creator
        $musicCreator = MusicCreator::create($validatedData);
        
        ActivityLogHelper::log('created', 'MusicCreator', $musicCreator->id, 'add new credit');
        
        return redirect()->route('credits.index')->with('success', 'Music creator created successfully!');
    }

    // Display the specified music creator
    public function show(MusicCreator $creator)
    {
        return view('credits.show', compact('creator'));
    }

    
    public function showinfo($id)
{
   
    $creator = MusicCreator::find($id);
   

    return response()->json([
        'name' => $creator->name,
        'local' => $creator->local,
        'district' => $creator->district,
        'duty' => $creator->duty,
        'birthday' => $creator->birthday,
        'usic_background' => $creator->music_background,
        'designation' => $creator->designation,
        'image_url' => $creator->image_url,
    ]);
}

    // Show the form for editing the specified music creator
    public function edit(MusicCreator $creator)
    {
        return view('creators.edit', compact('creator'));
    }

    // Update the specified music creator in the database
    public function update(Request $request, MusicCreator $credit)
    {
        
        // Validate request data
        $validatedData = $request->validate([
            'edit_name' => 'required|max:255',
            'edit_local' => 'nullable|string',
            'edit_district' => 'nullable|string',
            'edit_duty' => 'nullable|string',
            'edit_birthday' => 'nullable|date',
            'edit_music_background' => 'nullable|string',
            'edit_designation' => 'required|integer',
        ]);

        
        $credit->update([
            'name' => $request->edit_name,
            'local' => $request->edit_local,
            'district' => $request->edit_district,
            'duty' => $request->edit_duty,
            'birthday' => $request->edit_birthday,
            'music_background' => $request->edit_music_background,
            'designation' => $request->edit_designation,
        ]);
        
        ActivityLogHelper::log('updated', $credit->name, $credit->id,  'update the credit');

        return redirect()->route('credits.index')->with('success', 'Music creator updated successfully!');
    }

    // Delete the specified music creator from the database
    public function destroy(MusicCreator $credit)
    {
        $credit->delete();

        ActivityLogHelper::log('deleted', $credit->name, $credit->id,  'delete the credit');

        return redirect()->route('credits.index')->with('success', 'Music creator deleted successfully!');
    }
}
