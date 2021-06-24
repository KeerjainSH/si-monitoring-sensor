<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\SensorStatus;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    // $dateFormat = 'U' ;
    public function fetchData(){
        $sensors = Sensor::orderBy('created_at', 'DESC')->take(10)->get();
        // dd($sensors);
        return $sensors;
    }

    public function getGraphicData() {
        $sensors = Sensor::select('created_at', 'sensor1', 'sensor2', 'sensor3', 'sensor4')->orderBy('created_at', 'DESC')->take(10)->get();
        return $sensors ;
    }

    public function addData(Request $request) {

        $status = SensorStatus::all() ;
        foreach($status as $i) {
            if ($i->status == 0 && $i->id == 1) {
                $request->sensor1 = 0 ;
            }
            if ($i->status == 0 && $i->id == 2) {
                $request->sensor2 = 0 ;
            }
            if ($i->status == 0 && $i->id == 3) {
                $request->sensor3 = 0 ;
            }
            if ($i->status == 0 && $i->id == 4) {
                $request->sensor4 = 0 ;
            }
        }
        
        // 1. Datanya ada tapi 0
        // 2. Datanya null
        // 3. Datanya ada dan gak 0 tapi dibaca 0 sama website

        $sensor = Sensor::create([
            'sensor1' => $request->sensor1,
            'sensor2' => $request->sensor2,
            'sensor3' => $request->sensor3,
            'sensor4' => $request->sensor4
        ]) ;
        return $sensor ;
    }

    public function fetchDataExcel() {
        $path = storage_path('app\sensorData.xlsm') ;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $reader->load($path);
        $workSheet = $spreadSheet->getActiveSheet();
        $startRow = 2;
        $max = 3000;
        $columns = [
            "A"=>"sensor1",
            "B"=>"sensor2",
            "C"=>"sensor3",
            "D"=>"sensor4",
            "E"=>"created_at"
        ];
        $data_insert = [];
        for($i=$startRow; $i<$max; $i++){
            
            $data_row = [];
            $status = 1 ;
            foreach ($columns as $col=>$field) {
                $val = $workSheet->getCell("$col$i")->getValue();
                
                if(empty($val) || $val == 0) {
                    $status = 0 ;
                    break ;
                }
                
                if ($col == "E") {
                    $val = date('Y-m-d H-i-s' ,\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($val, "Asia/Jakarta"));
                }
                $data_row[$field] = $val;
            }
            if ($status)
                $data_insert[] = $data_row;
        }
        \DB::table('sensor')->truncate();
        \DB::table('sensor')->insert($data_insert);
        return 'success' ;
    }

    public function getStatus($id) {
        $status = SensorStatus::find($id) ;
        return $status->status ; 
    }
}
