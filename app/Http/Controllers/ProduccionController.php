<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index(Request $request){
        $busqueda = $request->busqueda;
        $usuarios = Produccion::paginate(12);
        return view('produccion', compact('usuarios','busqueda'));
    }
    public function filtro_name(Request $request){
        $busqueda = $request->busqueda;
        if($request->name == ''){
            $usuarios = Produccion::paginate(12);
        }else{
            $usuarios = Produccion::where('name', $request->name)->paginate(12);
        }
        return view('produccion', compact('usuarios', 'busqueda'));
    }

    public function store(Request $request)
    {
        $usuarios = new  Produccion();
        $usuarios->ref = $request->ref;
        $usuarios->operario = $request->operario;
        $usuarios->piezas_buenas = $request->piezas_buenas;
        $usuarios->piezas_malas = $request->piezas_malas;
        $usuarios->fecha_inicio = $request->fecha_inicio;
        $usuarios->fecha_fin = $request->fecha_fin;
        $usuarios->gastos_adicionales = $request->gastos_adicionales;
        $usuarios->observaciones = $request->observaciones;

        $usuarios->save();
        return redirect()->route('produccion.ver');
    }

    public function update(Request $request){
    
        $usuarios = Produccion::find($request->id); 
        $usuarios->ref = $request->ref;
        $usuarios->operario = $request->operario;
        $usuarios->piezas_buenas = $request->piezas_buenas;
        $usuarios->piezas_malas = $request->piezas_malas;
        $usuarios->fecha_inicio = $request->fecha_inicio;
        $usuarios->fecha_fin = $request->fecha_fin;
        $usuarios->gastos_adicionales = $request->gastos_adicionales;
        $usuarios->observaciones = $request->observaciones;

        $usuarios->save();
        return redirect()->route('produccion.ver');
    }

    public function destroy($id){
        Produccion::where('id',$id)->first()->delete();
        return redirect()->route('produccion.ver');
    }
}
