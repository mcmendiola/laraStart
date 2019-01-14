<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PHPJasper\PHPJasper;
class ReportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return 1; 
    }

    public function jrpt($id = 0,$vdtime="")
    {
        
        $outputFile = public_path('js/ViewerJS/reports/'.$vdtime);
        $options = [
            'format' => ['pdf'],
            'params' => [
                'byID' => $id
            ],
            'db_connection' => [
                'driver' => env('RPT_CONNECTION'),
                'username' => env('RPT_USERNAME'),
                'password' => env('RPT_PASSWORD'),
                'host' => env('RPT_HOST'),
                'database' => env('RPT_DATABASE'),
                'port' => env('RPT_PORT')
            ]
        ];
        $jasper = new PHPJasper;
        $inputFile = public_path('js/ViewerJS/rptReport/reportjasper.jasper');
        
        $jasper->process(
            $inputFile,
            $outputFile,
            $options
        )->execute();
        
        return url('js/ViewerJS/reports/'.$vdtime.'.pdf');
    }
}
