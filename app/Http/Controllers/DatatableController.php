<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;

class DatatableController extends Controller
{
    public function solicitudes($param){
        
        \Log::info('Ingresó al controlador de datatable'); 
        \Log::info($param);   

        $solicitudes=Solicitudes::select('id','nombre','estadologico')->where('ptoactual','=',$param)->get();
        
        \Log::info($solicitudes); 

        return datatables()->of($solicitudes)
        //return Datatables::of($solicitudes)->make(true)
        ->addColumn('btn','solicitudes.btn')
        ->rawColumns(['btn'])        
        ->toJson();
    }
}
