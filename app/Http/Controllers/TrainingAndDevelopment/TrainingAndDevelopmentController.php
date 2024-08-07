<?php

namespace App\Http\Controllers\TrainingAndDevelopment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrainingAndDevelopmentController extends Controller
{
    public function index()
    {
        return Inertia::render('TrainingAndDevelopment/TrainingAndDevelopment');
    }
}
