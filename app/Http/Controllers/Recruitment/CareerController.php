<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class CareerController extends Controller
{
    public function index()
    {
        return Inertia::render('Recruitment/Careers');
    }

    
}
