<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        return Inertia::render('Company/Calendar');
    }


    public function getCalendarinMonths(Request $request)
    {
        $list=array();
        $month = $request->month;
        $year = $request->year;


        for($d=1; $d<=31; $d++) {
            $time=mktime(12,0,0, $month, $d, $year);
            if(date('m', $time)==$month)
                $list[]=date('Y-m-d#D', $time);
        }

        return $list;

    }
    public function getlist(Request $request){

        $holidays = Holiday::all();
        return $holidays;
    }


}
