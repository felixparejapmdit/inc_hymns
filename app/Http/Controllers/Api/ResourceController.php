<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index($resource)
    {
        $table = $this->getTable($resource);
        if (!$table) return response()->json(['error' => 'Resource not found'], 404);
        
        $data = DB::table($table)->get();
        return response()->json($data);
    }

    public function show($resource, $id)
    {
        $table = $this->getTable($resource);
        if (!$table) return response()->json(['error' => 'Resource not found'], 404);
        
        $item = DB::table($table)->where('id', $id)->first();
        if (!$item) return response()->json(['error' => 'Item not found'], 404);
        
        return response()->json($item);
    }

    public function store(Request $request, $resource)
    {
        $table = $this->getTable($resource);
        if (!$table) return response()->json(['error' => 'Resource not found'], 404);
        
        $id = DB::table($table)->insertGetId($request->all());
        $item = DB::table($table)->where('id', $id)->first();
        
        return response()->json($item, 201);
    }

    public function update(Request $request, $resource, $id)
    {
        $table = $this->getTable($resource);
        if (!$table) return response()->json(['error' => 'Resource not found'], 404);
        
        DB::table($table)->where('id', $id)->update($request->all());
        $item = DB::table($table)->where('id', $id)->first();
        
        return response()->json($item);
    }

    public function destroy($resource, $id)
    {
        $table = $this->getTable($resource);
        if (!$table) return response()->json(['error' => 'Resource not found'], 404);
        
        DB::table($table)->where('id', $id)->delete();
        
        return response()->json(['message' => 'Deleted successfully']);
    }

    private function getTable($resource)
    {
        $map = [
            'categories' => 'categories',
            'instrumentations' => 'instrumentations',
            'ensemble-types' => 'ensemble_types',
            'languages' => 'languages',
            'church-hymns' => 'church_hymns',
        ];
        
        return $map[$resource] ?? null;
    }
}
