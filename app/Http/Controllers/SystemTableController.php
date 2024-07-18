<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\General\CommonController;
use App\Models\SystemTable;

class SystemTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SystemAdministration/SystemTable');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $modelname = CommonController::getModelByTablename($request->table_name);
        
        return SystemTable::create([
            'table_name' => str_replace("hris_", "", $request->table_name),
            'model_name' => str_replace("Hris", "", $modelname),
            'is_migrated' => 1,
            'is_columns_migrated' => 0,
            'created_by' => 'SYSTEM'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listalldata(){
       $query= SystemTable::all();
       return $query;
    }
}
