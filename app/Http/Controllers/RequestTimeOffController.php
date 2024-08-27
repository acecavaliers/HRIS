<?php

namespace App\Http\Controllers;

use App\Models\RequestTimeOff;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestTimeOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Timekeeping/RequestTimeOff');
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
    public function show(RequestTimeOff $requestTimeOff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestTimeOff $requestTimeOff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestTimeOff $requestTimeOff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestTimeOff $requestTimeOff)
    {
        //
    }

    public function getList(Request $request)
    {
        $query = RequestTimeOff::paginate($request->showrecords);

        return $query;
    }

    public function getcolumns(Request $request)
    {
        $systemtable = SystemTable::where('model_name', $request->modelName)->first();
        return SystemTableDetail::with('formtypes')->where('system_table_id', $systemtable->id)->get();
    }
}
