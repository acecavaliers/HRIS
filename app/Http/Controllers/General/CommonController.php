<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Support\Facades\Route;
use URL;
use App\Models\DataType;
use App\Models\DatatypeFormtype;
use App\Models\AutoGenerateCode;
class CommonController extends Controller
{




    public function getCountNotYetMigrated(Request $request){

        $systemtable =  SystemTable::where('id', $request->systemTableID)->first();
        $systemtabledetails = SystemTableDetail::where(array('system_table_id' => $request->systemTableID))->get();

        if($systemtable->is_columns_migrated == 1){
            $modelName = $request->modelname;
            $model = '\\App\\Models\\'.$modelName;
            $dynamicmodel = new $model;
            $table = $dynamicmodel->getTable();
            $columns = Schema::getColumnListing($table);
            $countcolumns = count($columns);
            $systemtabledetailscount = count($systemtabledetails);
            return ['columncount' => $countcolumns, 'systemtabledetailscount' => $systemtabledetailscount];
        }
      /*   $result = '';


                $modelName = $request->modelname;
                $model = '\\App\\Models\\'.$modelName;
                $dynamicmodel = new $model;
                $table = $dynamicmodel->getTable();
                $columns = Schema::getColumnListing($table);
                $countcolumns = count($columns);
                $systemtabledetailsexistcount = count($systemtabledetails);
                if($countcolumns == $systemtabledetailsexistcount){
                    $result = 'Migrated';
                }else{
                    $result =  'Partially Migrated';
                }
            }else{
                $result =  'Not Yet Migrated';
            }

            return $result; */

    }

    public static function getTableColumnsFinal(Request $request){
        $modelName = $request->modelname;
        $model = '\\App\\Models\\'.$modelName;
        $dynamicmodel = new $model;
        $table = $dynamicmodel->getTable();
        $columns = Schema::getColumnListing($table);
        return $columns;
    }


    public static function getTableColumns(Request $request){

        $count = 0;
        $modelName = $request->modelname;
        $model = '\\App\\Models\\'.$modelName;
        $dynamicmodel = new $model;
        $table = $dynamicmodel->getTable();
        $columns = Schema::getColumnListing($table);

        $className = '';
        $foreignkeys = $dynamicmodel->getForeignKeys();
        $isforeignkey = 0;


        $systemtable =  SystemTable::where('id', $request->systemTableID)->first();

        foreach($columns as $column){
            $systemtablecolumnorder = SystemTableDetail::where(array('system_table_id' => $request->systemTableID))->orderBy('column_order', 'desc')->first();
            $systemtablesearchorder = SystemTableDetail::where(array('system_table_id' => $request->systemTableID))->orderBy('search_order', 'desc')->first();
            $systemtabledetails = SystemTableDetail::where(array('system_table_id' => $request->systemTableID, 'column_name' =>$column))->get();

            $coltype = DB::getSchemaBuilder()->getColumnType($table, $column);
            $columnordercount = 0;
            $searchordercount = 0;
            if($systemtablecolumnorder) {
                $columnorder = $systemtablecolumnorder->column_order + 1;

            }else{
                $columnorder = $columnordercount + 1;
            }

            if($systemtablesearchorder) {
                $searchorder = $systemtablesearchorder->search_order + 1;

            }else{
                $searchorder = $searchordercount + 1;
            }

            //get the form types that si default
            $datatype = DataType::where('name', $coltype)->first();
            $datatypeformtype = DatatypeFormtype::where(array('is_default' => 1, 'data_type_id' =>$datatype->id))->first();

            //if columns is not yet existing in the database
            if(count($systemtabledetails) == 0){

                    SystemTableDetail::create([
                        'system_table_id' => $request->systemTableID,
                        'column_name' => $column,
                        'column_label' => ucwords(str_replace('_', ' ', $column)),
                        'column_type' => $coltype,
                        'column_order' => $columnorder,
                        'search_order' => $searchorder,
                        'is_foreignkey' => in_array($column, array_values($foreignkeys)) ? 1 : 0,
                        'reference_table' => in_array($column, array_values($foreignkeys)) ? Str::studly(Str::singular(array_search($column, $foreignkeys))) : '',
                        'refrence_table_column' => '',
                        'required_text' => $column.' is required',
                        'form_type_id' => $datatypeformtype->form_type_id,
                        'created_by' => 'SYSTEM'
                    ]);

            }
        } //end foreach



         SystemTable::where('id', $request->systemTableID)->update([
            'is_columns_migrated' => 1
        ]);

        return 'success';

    }


    public function getTableNames(){

        try{

            $dbconn = config('database.default');

            if($dbconn == 'mysql'){
                $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'hrisdb'");

                foreach($tables as $key => $table){
                    $table_names[] = $table->table_name; // Table_in_{{your database name in my case database name is devtrigger}}
                }

            }else if($dbconn == 'sqlsrv'){
                $tables = DB::select('select * from sys.tables where name like ?', ['%hris_%']);


                foreach($tables as $key => $table){
                    $table_names[] = $table->name; // Table_in_{{your database name in my case database name is devtrigger}}
                }
            }else{

            }

            return $table_names;
          }
          catch(\Exception $e){
            return $e;
          }
    }

    public static function getModelByTablename($tablename) {
        return Str::studly(Str::singular($tablename));
    }

    public function getCurrentNavSidebar(){
        $currentnavtabs = [];
        $modules = Module::with('submodules')->where('is_active', 1)->get();

        foreach($modules as $module){
            /* emoved: $module->is_current == 1 && */
            if($module->has_children == 1){
                foreach($module->submodules as $submodules){
                    if($submodules->is_current == 1){
                        array_push($currentnavtabs,$submodules->navtabs);

                    }
                }
            }
        }

        return $currentnavtabs;
    }

    public function updateEnableDisplayColumn(Request $request){
        SystemTableDetail::query()->update(['enable_display_column' => 0]);
        foreach($request->filtereddatacolumns as $data){

            SystemTableDetail::where('id', $data['id'])->update(['enable_display_column' => 1]);
        }

        return 'success';
    }

    public function updateEnableDisplayColumnForDefault(){
        SystemTableDetail::where('default_display_column', 1)->update(['enable_display_column' => 1]);

        return 'success';
    }

    public static function getTableSettingId($modelname){
        $modelName = $modelname;

        $model = '\\App\\Models\\'.$modelName;
        $dynamicmodel = new $model;
        $table = $dynamicmodel->getTable();
        $tablesetting = SystemTable::where('table_name', $table)->first();
        return $tablesetting->id;

    }


    public function getSearchFormColumns(Request $request){

        $pageurl = str_replace("/", "",$request->pageurl);
        $modules = Module::with('submodules')->get();
        if($request->ismainsidebar == 'true'){
           
           
            foreach($modules as $module){
                if($module->url_name == $pageurl){
                     $currentmoduleactive = Module::where('id', $module->id)->first();
                     $systemtableid = CommonController::getTableSettingId($currentmoduleactive->model_name);
                     $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_search' => 1))->whereNotNull('form_type_id')->orderBy('search_order', 'asc')->get();
                }else{
                    foreach($module->submodules as $submodules){
                        if($submodules->url_name == $pageurl){
                            $submodulecurrent = Submodule::where(['url_name' => $pageurl, 'is_active' => 1])->first();
                            $systemtableid = CommonController::getTableSettingId($submodulecurrent->model_name);
                            $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_search' => 1))->whereNotNull('form_type_id')->orderBy('search_order', 'asc')->get();
                        }
                    }
    
                }
            }

           
        }else{
            
            $systemtableid = CommonController::getTableSettingId($request->model_name);
            $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_search' => 1))->whereNotNull('form_type_id')->orderBy('search_order', 'asc')->get();
            
        
        }

       

        return $columns;



       /*  $query = SystemTableDetails::with('formtype')->where(array('system_table_id' => $request->systemtableID, 'enable_search' => 1))->whereNotNull('form_type_id')->orderBy('search_order', 'asc')->get();
        return $query; */
    }


    public function getAddFormColumns(Request $request){

        //if modules and submodules are present

       /*  return $request; */
        
     /*    $modules = Module::with('submodules')->get();
        $pageurl = str_replace("/", "",$request->pageurl); */
        $columns = [];


        $systemtableid = CommonController::getTableSettingId($request->model_name);
        $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_addform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
      //  return 'false';
        return $columns;
       
       /*  if($request->ismainsidebar == 'true'){
            foreach($modules as $module){
                if($module->url_name == $pageurl){
                     $currentmoduleactive = Module::where('id', $module->id)->first();
                     $systemtableid = CommonController::getTableSettingId($currentmoduleactive->model_name);
                     $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_addform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
                }else{
                    foreach($module->submodules as $submodules){
                        if($submodules->url_name == $pageurl){
                            $submodulecurrent = Submodule::where(['url_name' => $pageurl, 'is_active' => 1])->first();
                            $systemtableid = CommonController::getTableSettingId($submodulecurrent->model_name);
                            $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_addform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
                        }
                    }
    
                }
                
            }

            return 'true';
         //   return $columns;
         
        }else{

          
            $systemtableid = CommonController::getTableSettingId($request->model_name);
            $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_addform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
            return 'false';
            return $columns;
       
        } */
     
          

        
    

       // return $columns;
   
    }

    public function getAddFormColumnsCustom(Request $request){
        $systemtableid = CommonController::getTableSettingId($request->modelName);
        $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_addform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
        return $columns;
    }

    public function getEditFormColumns(Request $request){

  /*       $modules = Module::with('submodules')->get();
        $pageurl = str_replace("/", "",$request->pageurl);

        foreach($modules as $module){
            if($module->url_name == $pageurl){
                 $currentmoduleactive = Module::where('id', $module->id)->first();
                 $systemtableid = CommonController::getTableSettingId($currentmoduleactive->model_name);
                 $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_editform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
            }else{
                foreach($module->submodules as $submodules){
                    if($submodules->url_name == $pageurl){
                        $submodulecurrent = Submodule::where(['url_name' => $pageurl, 'is_active' => 1])->first();
                        $systemtableid = CommonController::getTableSettingId($submodulecurrent->model_name);
                        $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_editform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
                    }
                }

            }
        } */

        $columns = [];
        $systemtableid = CommonController::getTableSettingId($request->model_name);
        $columns = SystemTableDetail::with('formtypes', 'texteditors')->where(array('system_table_id' => $systemtableid, 'enable_editform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
        return $columns;


       /*  $columns = SystemTableDetails::with('formtype')->where(array('system_table_id' => $request->systemtableID, 'enable_editform' => 1))->whereNotNull('form_type_id')->orderBy('column_order', 'asc')->get();
        return $columns; */
    }

    public function getActiveModuleCurrentColumns(Request $request){
        $modules = Module::with('submodules')->get();
        $pageurl = str_replace("/", "",$request->pageurl);

        if($request->ismainsidebar == 'true'){
            foreach($modules as $module){
                if($module->url_name == $pageurl){
                     $currentmoduleactive = Module::where('id', $module->id)->first();
                     $systemtableid = CommonController::getTableSettingId($currentmoduleactive->model_name);
                     $columns = SystemTableDetail::where(array('system_table_id' => $systemtableid))->get();
                }else{
                    foreach($module->submodules as $submodules){
                        if($submodules->url_name == $pageurl){
                            $submodulecurrent = Submodule::where(['url_name' => $pageurl, 'is_active' => 1])->first();
                            $systemtableid = CommonController::getTableSettingId($submodulecurrent->model_name);
                            $columns = SystemTableDetail::where(array('system_table_id' => $systemtableid))->get();
                        }
                    }
    
                }
            }

        }else{
            $systemtableid = CommonController::getTableSettingId($request->model_name);
            $columns = SystemTableDetail::where(array('system_table_id' => $systemtableid))->get();
        }
    

        return $columns;
    }

    public function getDataFromForeignKey(Request $request){


        $model = '\\App\\Models\\'.$request->modelname;
        $dynamicmodel = new $model;

       
        if($request->wherecolumn !=='' && $request->wherecolumn !== null){

            //wherecolumn having referenced with other table (e.g.: employees.name) - wherehas
            if(count(explode(".", $request->wherecolumn)) > 1){
                $finaldata = $dynamicmodel->with(explode(".", $request->wherecolumn)[0])->whereHas(explode(".", $request->wherecolumn)[0], function($query) use ($request) {
                    $query->where(explode(".", $request->wherecolumn)[1], $request->formvalue);
                })->where('is_active', 1)->get();
            }else{

                if($request->formtype == 'dropdown'){
                    $finaldata = $dynamicmodel->where(explode(".", $request->wherecolumn)[0], $request->formvalue)->
                    where('is_active', 1)->get();
                }else {
                    $finaldata = $dynamicmodel->where(explode(".", $request->wherecolumn)[0], $request->formvalue)->
                    where('is_active', 1)->first();
                }
             
            }
            
        }else{

       
            $finaldata = $dynamicmodel->where('is_active', 1)->get();

           
        }

        return $finaldata;

    }

    public function getCurrentModuleByPageUrl(Request $request){
        $modules = Module::with('submodules')->get();
        $pageurl = str_replace("/", "",$request->pageurl);

        if($request->ismainsidebar == 'true'){
            foreach($modules as $module){
                if($module->url_name == $pageurl){
                     $currentmoduleactive = Module::where('id', $module->id)->first();
                    // $systemtableid = CommonController::getTableSettingId($currentmoduleactive->model_name);
                     $currentsystemtable = SystemTable::where('model_name', $currentmoduleactive->model_name)->first();
                }else{
                    foreach($module->submodules as $submodules){
                        if($submodules->url_name == $pageurl){
                            $submodulecurrent = Submodule::where(['url_name' => $pageurl, 'is_active' => 1])->first();
                           // $systemtableid = CommonController::getTableSettingId($submodulecurrent->model_name);
                           $currentsystemtable = SystemTable::where('model_name', $submodulecurrent->model_name)->first();
                        }
                    }
    
                }
            }
        }else{
            $currentsystemtable = SystemTable::where('model_name', $request->model_name)->first();
        }

       

        return $currentsystemtable;

    }


    public static function getRequiredFields($modelname, Request $request){
        $systemtable =  SystemTable::where('model_name', $modelname)->first();
        
        $systemtabledetailsrequired = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_required' => 1))->orderBy('column_order', 'asc')->get();
        $systemtabledetailsrequiredif = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_required_if' => 1))->orderBy('column_order', 'asc')->get();
        $arrdetails = [];
        $arrfinal = [];
        if(count($systemtabledetailsrequired) > 0){
            foreach($systemtabledetailsrequired as $stabledetailsreq){
                /* Required */
                $arrdetails['formdata.'. $stabledetailsreq['column_name']] = 'required';
              
               // $arrfinal = 'formdata.'.$arrdetails;
            }
    

        }
        
        if(count($systemtabledetailsrequiredif) > 0){

       
            foreach($systemtabledetailsrequiredif as $stabledetailsreqif){
            
               if($stabledetailsreqif['required_if_another_field']){
                $arrdetails['formdata.'. $stabledetailsreqif['column_name']] = 'required_if:'.'formdata.'.$stabledetailsreqif['required_if_field'].'.'. $stabledetailsreqif['required_if_another_field'].','.$stabledetailsreqif['required_if_value'];
               }else{
                $arrdetails['formdata.'. $stabledetailsreqif['column_name']] = 'required_if:'.'formdata.'.$stabledetailsreqif['required_if_field'].','.$stabledetailsreqif['required_if_value'];
               }

              
              
            }
        }
     

       
       /*  return $arrdetails;
 */
        return $request->validate($arrdetails);

    }

    public static function getUniqueData($modelname, Request $request){
        $systemtable =  SystemTable::where('model_name', $modelname)->first();
        $systemtabledetails = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_unique' => 1))->get();
        $arrdetails = [];
        $arrfinal = [];
        foreach($systemtabledetails as $stabledetails){
            $arrdetails['formdata.'. $stabledetails['column_name']] = 'unique:'.$systemtable->table_name.','.$stabledetails['column_name'];
           // $arrfinal = 'formdata.'.$arrdetails;
        }

        return $request->validate($arrdetails);
    }

    public static function getAllDates($startingDate, $endingDate){
        $datesArray = [];

        $startingDate = strtotime($startingDate);
        $endingDate = strtotime($endingDate);
             
        for ($currentDate = $startingDate; $currentDate <= $endingDate; $currentDate += (86400)) {
            $date = date('Y-m-d', $currentDate);
            $datesArray[] = $date;
        }
  
        return $datesArray;
    }

    public function getModelNames() {
        $path = app_path('Models') . '/*.php';
        return collect(glob($path))->map(fn ($file) => basename($file, '.php'))->toArray();
    }

    public function getDataFromReferenceTable(Request $request){
        $model = '\\App\\Models\\'.$request->modelname;
        $dynamicmodel = new $model;

        if($request->category == 'getdatadropdown'){
            $finaldata = $dynamicmodel->where('is_active', 1 )->get();
          
        }else{
            $finaldata = $dynamicmodel->where($request->referencetablecolumn, $request->datavalue)->first();
        }
      
        return $finaldata;

     

        

    }

    public function getDataFromReferenceTableWhereColumn(Request $request){
        $model = '\\App\\Models\\'.$request->modelname;
        $dynamicmodel = new $model;

        $finaldata = $dynamicmodel->where($request->wherecolumn, $request->formvalue)->get();

        return $finaldata;
    }

    public static function getNextNumberInAutoGenerateCode($systemtabledetailsid){
        $autogenerate = AutoGenerateCode::where('system_table_detail_id',$systemtabledetailsid)->first();
        $save =  AutoGenerateCode::where('system_table_detail_id', $systemtabledetailsid)->update([
            'current_no' => $autogenerate->next_no,
            'next_no' => $autogenerate->next_no+1
        ]); 

        return $save;

    }


    

}
