<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Auth;
use App\Http\Controllers\General\CommonController;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Maintenance/Holiday');
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
        $validated = CommonController::getRequiredFields('Holiday', $request);

        $systemtable = SystemTable::where('table_name', 'holidays')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();


        $arr = $request->formdata;


        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($data['saving_referenced_field'])){

                        $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];

                }
            }

        }
        $arr['created_by'] = Auth::user()->name;

        $arr['from_datetime'] = Carbon::parse($arr['from_datetime'])->format('Y-m-d H:i:s');
        $arr['to_datetime'] = Carbon::parse($arr['to_datetime'])->format('Y-m-d H:i:s');


        $query = Holiday::create($arr);
        return 'success';
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
        $validated = CommonController::getRequiredFields('Holiday', $request);

        $systemtable = SystemTable::where('table_name', 'holidays')->first();
        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();


        $arr = $request->formdata;


        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($data['saving_referenced_field'])){

                        $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];

                }
            }

        }
        $arr['from_datetime'] = Carbon::parse($arr['from_datetime'])->format('Y-m-d H:i:s');
        $arr['to_datetime'] = Carbon::parse($arr['to_datetime'])->format('Y-m-d H:i:s');
        $arr['updated_by'] = Auth::user()->name;

        $query = Holiday::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Holiday::where('id', $id)->update(['deleted_by'=> Auth::user()->name]);
        Holiday::where('id', $id)->delete();
        return 'success';
    }


    public function getlist(Request $request){

        // $query = Holiday::with('holidaytypes')->paginate($request->showrecords);
        // return $query;

        $parameterCount = count($request->all());
        if ($parameterCount>1 ){

            $year =  date('Y',strtotime($request->presentMonth));

            $holidays = Holiday::whereYear('from_datetime', $year)
                                ->paginate($request->showrecords);

            return $holidays;

        }
        else{
            $month = date('m',strtotime($request->presentMonth));
            $year =  date('Y',strtotime($request->presentMonth));

            $holidays = Holiday::whereYear('from_datetime', $year)
                                ->whereMonth('to_datetime', $month)
                                ->paginate($request->showrecords);

            return $holidays;
        }

    }
    public function getTodayEvent(Request $request){

        $new_Date= $request->newDate;
        if ($new_Date== ''){
            $new_Date=Carbon::now()->toDateString();
        }
        $searchDate= strtotime($new_Date);
        $newformat = date('Y-m-d',$searchDate);
        $holidays = Holiday::whereDate('from_datetime','<=', $newformat)
                            ->whereDate('to_datetime','>=', $newformat)
                            ->paginate($request->showrecords);

        return $holidays;
    }

    public function getWeeklyEvent(Request $request){

        $star_Date = $request->startDate;
        $end_Date = $request->endDate;

        $startDate = date('Y-m-d',strtotime($star_Date));
        $endDate =  date('Y-m-d',strtotime($end_Date));

        $holidays = Holiday::whereBetween('from_datetime', [$star_Date, $endDate])
                            ->orWhereBetween('to_datetime', [$star_Date, $endDate])
                            ->paginate($request->showrecords);


        return $holidays ;
    }

    public function getcolumns(Request $request)
    {
        $systemtable = SystemTable::where('model_name', $request->modelName)->first();
        return SystemTableDetail::with('formtypes', 'systemtables')->where('system_table_id', $systemtable->id)->get();
    }

    public function searchData(Request $request){


        /*     return $request->is_active_all; */
            DB::enableQueryLog();
            //$searchdatadecode = json_decode($request->searchdata);
            $searchdatadecode = $request->searchdata;
            $val = 0;
            $query = Holiday::query();
            foreach($searchdatadecode as $key=>$value){

                if($request->is_active_all == 'false'){
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $query->where($key, $value);

                        }else{
                            $query->where($key, 'LIKE', '%'.$value.'%');
                        }
                    }
                }else{
                    if($key!= 'deleted_at'){
                        if($key == 'created_at' || $key=='updated_at'){
                            $query->whereDate($key, 'LIKE', '%'.$value.'%');
                        }else if($key=='is_active'){
                            $query->whereIn($key, [0,1]);


                        }else{
                            $query->where($key, 'LIKE', '%'.$value.'%');
                        }
                    }
                }
            }


            $data = $query->paginate(10);
            return $data;
          /*   return DB::getQueryLog(); */

        }


}
