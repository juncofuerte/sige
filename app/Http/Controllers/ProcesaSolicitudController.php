<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificaSolMailable;

class ProcesaSolicitudController extends Controller
{
    public function procesa(Request $request)
    {       
        $input = $request->all();  //se obtienen todos los datos del formulario

        \Log::info('------------------------------------------------------------------------');
        \Log::info($input);

        //******* SECCIÓN SUBIR LOS ARCHIVOS AL SERVIDOR  

        $archivos= $request->file('archivos');  //obtenemos la lista de archivos
        $usuario=auth()->user()->name;  //obtenemos el nombre del usuario logeado (no viene del formulario)
        $idusuario=auth()->user()->id;  // obtiene el id del usuario que está generando la solicitud
        $secuencia=0;
        $destino=public_path('docsolicitud');  //carpeta donde se van almacenar los archivos subidos
        foreach($archivos as $archivo){  //se itera archivo a archivo
            $nombre=$archivo->getClientOriginalName(); //se obtiene el nombre del archivo
            $secuencia++;
            $aleatorio=mt_rand(1,30000000);
            $nombrenuevo= $usuario."_".$secuencia."_".$aleatorio."_".microtime()."+".$nombre; //se forma el nuevo nombre único para almacenar en la carpeta            
            $archivo->move($destino, $nombrenuevo);  //se sube el archivo al servidor
            \Log::info($nombre);
            \Log::info($nombrenuevo);
        };
        

       //******* SECCION PARA GRABAR EN LA BD

        $idsolicitud='2468';
        $destino='gestor@dem.cl';

       //ESTA SECCIÓN ENVÍA EL MAIL A LA LISTA DE DISTRIBUCIÓN DEFINIDA
       Mail::to($destino)->queue(new NotificaSolMailable($idsolicitud));

        //retorna el id de la solicitud generado en BD para mostrarlo en el modal resumen
        return response()->json(array('success'=>true, 'idsolicitud'=>$idsolicitud));
    }    
}