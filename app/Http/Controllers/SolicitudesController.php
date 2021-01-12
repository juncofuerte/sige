<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipocompras;
use App\Models\Tipofondos;
use App\Models\Adjuntos;

class SolicitudesController extends Controller
{
    public function index($param){
        \Log::info('Entré al controlador de Solicitudes');
        \Log::info($param); 
        //$solicitudes=Solicitudes::all();      
        return view('solicitudes.index',compact('param'));
    }

    public function crear(){

        $tipocompras=Tipocompras::where('vigencia','=',1)->get();
        $tipofondos=Tipofondos::where('flag_vigencia','=',1)->get();
        $tipoadjuntos=Adjuntos::where('vigencia','=',1)->get();

        
        return view('solicitudes.crear',['tipocompras'=>$tipocompras, 'tipofondos'=>$tipofondos, 'tipoadjuntos'=>$tipoadjuntos]);    

    }
}

 
