<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index(Request $request){
        $busqueda = $request->busqueda;
        $usuarios = Produccion::paginate(12);
        return view('usuarios', compact('usuarios','busqueda'));
    }
    public function filtro_name(Request $request){
        $busqueda = $request->busqueda;
        if($request->name == ''){
            $usuarios = Produccion::paginate(12);
        }else{
            $usuarios = Produccion::where('name', $request->name)->paginate(12);
        }
        return view('usuarios', compact('usuarios', 'busqueda'));
    }

    public function store(Request $request)
    {
        $usuarios = new  Produccion();
        $usuarios->name = $request->name;
        $usuarios->addres = $request->addres;
        $usuarios->birday = $request->birday;

        $name='';
        if (!empty($request -> file('foto'))) {
            $imagen = $request -> file('foto');
            $name = time(). '_'. $imagen -> getClientoriginalName();
            $ruta = public_path().'/fotos';
            $imagen->move($ruta,$name);
        }
        $usuarios->foto='/fotos/'.$name;


        $usuarios->save();
        return redirect()->route('usuarios.ver');
    }

    public function update(Request $request){
    
        $usuarios = Produccion::find($request->idOwner); 
        $usuarios->name = $request->name;
        $usuarios->addres = $request->addres;
        $usuarios->birday = $request->birday;

        $name='';
        if (!empty($request -> file('foto'))) {
            $imagen = $request -> file('foto');
            $name = time(). '_'. $imagen -> getClientoriginalName();
            $ruta = public_path().'/fotos';
            $imagen->move($ruta,$name);
        }
        $usuarios->foto='/fotos/'.$name;


        $usuarios->save();
        return redirect()->route('usuarios.ver');
    }

    public function destroy($idOwner){
        Produccion::where('idOwner',$idOwner)->first()->delete();
        return redirect()->route('usuarios.ver');
    }
}
