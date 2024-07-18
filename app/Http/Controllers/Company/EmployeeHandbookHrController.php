<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\CommonController;
use App\Models\EmployeeHandbook;
use App\Models\SystemTable;
use App\Models\SystemTableDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EmployeeHandbookHrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Company/EmployeeHandbookHr');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function getFileName(Request $request){
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|file|mimes:pdf,doc,docx',
            ]);

            $file = $request->file('file');
            $originalFilename = $file->getClientOriginalName();
            $filePath = $file->store('public/handbooks');
            $fileSize = $file->getSize();
            $fileType = $file->getMimeType();

            $fileSizeReadable = $this->formatBytes($fileSize);

            $fileDetails =[
                'file_path' => $filePath,
                'file_size' => $fileSizeReadable,
                'file_type' => $fileType,

            ];

            // Return the file information in the response
            return $fileDetails;

        }

    }

    private function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function store(Request $request)
    {
        $file = $request->formdata;
                $arr1 = $request->fileInfo;
                if(isset($arr1)){


                        $file['file_path'] = $arr1['file_path'];
                        $file['file_size'] = $arr1['file_size'];
                        $file['file_type'] = $arr1['file_type'];


                        // $title = $arr1['title'];
                        // $description = $arr1['description'];
                        $file['created_by'] = Auth::user()->name;
                        $query = EmployeeHandbook::create($file);

                        }
                //
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
        $validated = CommonController::getRequiredFields('EmployeeHandbook', $request);

        $systemtable = SystemTable::where('table_name', 'employee_handbooks')->first();

        $systemtabledetail = SystemTableDetail::where(array('system_table_id' => $systemtable->id, 'is_fk_getreferenced' => 0))->get();


        $arr = $request->formdata;


        if(count($systemtabledetail) > 0){
            foreach($systemtabledetail as $data){
                if(isset($data['saving_referenced_field'])){

                        $arr[$data['column_name']] = $request->formdata[$data['column_name']][$data['saving_referenced_field']];

                }
            }
        }
        $arr['updated_by'] = Auth::user()->name;

        $query = EmployeeHandbook::where('id', $id)->update($arr);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        EmployeeHandbook::where('id', $id)->update(['deleted_by'=> Auth::user()->name]);
        EmployeeHandbook::where('id', $id)->delete();
        return 'success';
    }


    public function getlist(Request $request)
    {
        // Retrieve a paginated list of employee handbooks with file information
        $query = EmployeeHandbook::paginate($request->showrecords);

        // Append file information to each handbook item
        $query->getCollection()->transform(function ($item) {
            // Assuming 'file_path', 'file_size', and 'file_type' are fields in the EmployeeHandbook model
            $substringToRemove = 'public/handbooks';
            $fileInfo = [
                'file_path' => str_replace($substringToRemove, '', $item->file_path),
                'file_size' => $item->file_size,
                'file_type' => $item->file_type,
            ];





            $item->file_info = $fileInfo;
            return $item;
        });

        return $query;
    }

    // Other methods...

    // Add a new route to handle file requests
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
            $query = EmployeeHandbook::query();
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
