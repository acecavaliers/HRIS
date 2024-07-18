<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecruitmentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Recruitment/RecruitmentDashboard');
    }
}
