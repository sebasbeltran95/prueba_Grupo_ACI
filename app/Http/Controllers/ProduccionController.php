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
        $usuarios->name = $request->name;
        $usuarios->addres = $request->addres;
        $usuarios->birday = $request->birday;

        $usuarios->save();
        return redirect()->route('produccion.ver');
    }

    public function update(Request $request){
    
        $usuarios = Produccion::find($request->idOwner); 
        $usuarios->name = $request->name;
        $usuarios->addres = $request->addres;
        $usuarios->birday = $request->birday;

        $usuarios->save();
        return redirect()->route('produccion.ver');
    }

    public function destroy($idOwner){
        Produccion::where('idOwner',$idOwner)->first()->delete();
        return redirect()->route('produccion.ver');
    }
}
