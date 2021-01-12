<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iniciativas;

class TraeIniciativasController extends Controller
{
    public function listaIniciativas($id){
        \Log::info($id);
        $iniciativas=Iniciativas::where('componente_id',$id)->get();
        \Log::info($iniciativas);
        return $iniciativas;
    }
}
