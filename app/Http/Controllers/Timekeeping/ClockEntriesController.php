<?php

namespace App\Http\Controllers\Timekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biometric;
use Inertia\Inertia;
use DB;
use App\Http\Controllers\General\CommonController;
class ClockEntriesController extends Controller
{
    public function index(){
        return Inertia::render('Timekeeping/ClockEntries');
    }

    public function getAllClockEntires(Request $request){
        return Biometric::paginate($request->showrecords);
    }

    public function getClockEntriesByUserID(Request $request){

        $arr = array();
        $dataarr = array();
        $finaldata = array();
        $selectedDateFrom = $request->extendParam[0];
        $selectedDateTo = $request->extendParam[1];
      //  $endDate = date('Y-m-d', strtotime($request->extendParam . ' +1 day'));
    /*     $endDatewithtime = $endDate.' 00:00:00.000'; */
        $dates = CommonController::getAllDates($selectedDateFrom, $selectedDateTo);
        
        $data =  Biometric::
        select(DB::raw("CONVERT(date, CHECKTIME) as CHECKINDATE, CHECKTIME, CHECKTYPE"))
        ->where('USERID', 1)
        ->whereBetween('CHECKTIME', [$selectedDateFrom,$selectedDateTo])
        ->groupBy(DB::raw('CONVERT(date, CHECKTIME)'), DB::raw('CHECKTIME'), DB::raw('CHECKTYPE'))
        ->paginate($request->showrecords);

        
        
            foreach($dates as $date){
                $arr['groupname'] = $date;
                $arr['children'] = Biometric::
                select(DB::raw("CONVERT(date, CHECKTIME) as CHECKINDATE, CHECKTIME, CHECKTYPE"))
                ->where('USERID', 1)
                ->whereDate(DB::raw('CONVERT(date, CHECKTIME)'), $date)
                /* ->whereBetween('CHECKTIME', [$selectedDateFrom,$selectedDateTo]) */
                ->groupBy(DB::raw('CONVERT(date, CHECKTIME)'), DB::raw('CHECKTIME'), DB::raw('CHECKTYPE'))
                ->paginate($request->showrecords);;
              
            

            $dataarr[] = $arr;
        
        }

      /*   foreach($dates as $date){
       

            foreach($data as $d){
                $arr['groupname'] = $date;
                if($d['CHECKINDATE'] == $date){
                    $arr['children'] = $data;
                }
                
            }
            $dataarr = $arr;
        }   

        $finaldata['data'] = $dataarr; */

        $finaldata['data'] = $dataarr;
       
        return $dataarr;
    }
}
