<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iniciativas;

class TraeDetalleController extends Controller
{
    public function detalle($id){
        \Log::info('Hugo');
        \Log::info($id);
        $detalle=Iniciativas::where('id',$id)->get();
        \Log::info($detalle);
        return $detalle;
    }
}
