<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;

use App\Models\Solicitudes;

//esto sólo lo agregamos para probar el envío de correos. se debe eliminar despues de probar
//use Illuminate\Support\Facades\Mail;
//use App\Mail\MessageReceived;


class PDFController extends Controller
{
    public function PDF(){
        

        // LA LÓGICA DE GENERACIÓN DEL PDF DE LA SOLICITUD ES SACAR LOS DATOS
        //RECIÉN INSERTADOS EN LA BD, DE MODO QUE CONTENGAN EXACTAMENTE LO QUE SE GRABÓ
        
        //$solicitudes=Solicitudes::all();
        $idusuario=1;
        $solicitud = Solicitudes::where('idusuario',$idusuario)->latest('id')->first();      

        //\Log::info($solicitud->nombre);
        \Log::info($solicitud->idusuario);

        $pdf= PDF::loadview('pdf/pdfsolicitud', compact('solicitud'));
        return $pdf->download('pdfsolicitud.pdf');//genera y baja el pdf al equipo del usuario
        
        //return $pdf->stream('solicitud.pdf');//genera y abre el pdf en la misma pantalla del usuario
                
    }
}