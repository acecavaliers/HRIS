<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonnelRequisitionSettingController extends Controller
{
    public function index(){
        return Inertia::render('Settings/PersonnelRequisition/PersonnelRequisitionMain');
    }
}
