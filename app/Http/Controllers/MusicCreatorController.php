<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicCreator;

use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\Storage;


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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
       
        // Handle image upload
        if ($request->hasFile('image')) {
          
            $imagePath = $request->file('image')->store('music_creators', 'public');
            $validatedData['image'] = $imagePath; // Store the image path in the validated data
        } else {
            $validatedData['image'] = null; // Set image to null if no image is uploaded
        }
    
        // Rename the 'add_designation' key to 'designation'
        $validatedData['designation'] = $validatedData['add_designation'];
        unset($validatedData['add_designation']);
   // dd($request);
        // Create new music creator
        $musicCreator = MusicCreator::create($validatedData);
        
        ActivityLogHelper::log('created', 'MusicCreator', $musicCreator->id, 'add new credit');
        //dd($validatedData);
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
        'image' => $creator->image,
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
            'edit_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
      
   // If a new image is provided, update it
   if ($request->hasFile('edit_image')) {
    // Delete the old image if it exists
    if ($credit->image) {
        Storage::disk('public')->delete($credit->image);
    }

        // Store the new image
        $imagePath = $request->file('edit_image')->store('music_creators', 'public');
        $validatedData['image'] = $imagePath;
    } else {
        $validatedData['image'] = $credit->image;
    }
        $credit->update([
            'name' => $request->edit_name,
            'local' => $request->edit_local,
            'district' => $request->edit_district,
            'duty' => $request->edit_duty,
            'birthday' => $request->edit_birthday,
            'music_background' => $request->edit_music_background,
            'designation' => $request->edit_designation,
            'image' => $validatedData['image'] ?? $credit->image,
        ]);
       // dd($filename);
       // dd($request);
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
