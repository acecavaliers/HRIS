<?php

namespace App\Http\Controllers;

use App\Models\RequestTimeOff;
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
}
