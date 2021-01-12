<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Componentes;

class TraeComponentesController extends Controller
{
    public function listaComponentes($id){
        \Log::info($id);
        $componentes=Componentes::where('tipofondos_id',$id)->get();
        \Log::info($componentes);
        return $componentes;
    }
}
    