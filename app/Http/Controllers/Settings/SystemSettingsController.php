<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SystemSettingsController extends Controller
{
    public function index(){
        return Inertia::render('Settings/SystemSettings/SystemSettings');
    }

    public function generalsettingsindex(){
        return Inertia::render('Settings/SystemSettings/GeneralSettings');
    }
}
