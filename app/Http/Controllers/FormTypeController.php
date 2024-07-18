<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataType;
use App\Models\FormType;

class FormTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    public function getFormTypebyDataType(Request $request){
      /*   $datatype = DataType::where('name', $request->columntype)->first();
        $query = FormType::with('datatypes')->whereHas('datatypes', function($query) use($request, $datatype) {
            $query->where('data_type_id', $datatype->id);
        } )->get();  */

       // $datatype = DataType::where('name', $request->columntype)->first();
        $query = DataType::with('formtypes')->get(); 
    
        return $query;
    }

    public function getFormTypebyDataTypeByID(Request $request){
        /*   $datatype = DataType::where('name', $request->columntype)->first();
          $query = FormType::with('datatypes')->whereHas('datatypes', function($query) use($request, $datatype) {
              $query->where('data_type_id', $datatype->id);
          } )->get();  */
  
         // $datatype = DataType::where('name', $request->columntype)->first();
          $result = DataType::with('formtypes')->whereHas('formtypes', function($query) use($request) {
            $query->where('form_type_id', $request->form_type_id);
          })->get(); 
      
          return $result;
      }
}
