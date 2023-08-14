<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedades;

class PropiedadesController extends Controller
{
    public function index(Request $request){
        $busqueda = $request->busqueda;
        $propiedades = Propiedades::paginate(12);
        return view('propiedades', compact('propiedades','busqueda'));
    }
    public function filtro_name(Request $request){
        $busqueda = $request->busqueda;
        if($request->name == ''){
            $propiedades = Propiedades::paginate(12);
        }else{
            $propiedades = Propiedades::where('name', $request->name)->paginate(12);
        }
        return view('propiedades', compact('propiedades', 'busqueda'));
    }

    public function store(Request $request)
    {
        $propiedades = new  Propiedades();
        $propiedades->name = $request->name;
        $propiedades->addres = $request->addres;
        $propiedades->price = $request->price;
        $propiedades->codeinternacional = $request->codeinternacional;
        $propiedades->year = $request->year;
        $propiedades->idOwner = $request->idOwner;


        $name='';
        if (!empty($request -> file('foto'))) {
            $imagen = $request -> file('foto');
            $name = time(). '_'. $imagen -> getClientoriginalName();
            $ruta = public_path().'/fotos';
            $imagen->move($ruta,$name);
        }
        $propiedades->foto='/fotos/'.$name;


        $propiedades->save();
        return redirect()->route('propiedades.ver');
    }

    public function update(Request $request){
    
        $propiedades = Propiedades::find($request->idProperty); 
        $propiedades->name = $request->name;
        $propiedades->addres = $request->addres;
        $propiedades->price = $request->price;
        $propiedades->codeinternacional = $request->codeinternacional;
        $propiedades->year = $request->year;
        $propiedades->idOwner = $request->idOwner;


        $name='';
        if (!empty($request -> file('foto'))) {
            $imagen = $request -> file('foto');
            $name = time(). '_'. $imagen -> getClientoriginalName();
            $ruta = public_path().'/fotos';
            $imagen->move($ruta,$name);
        }
        $propiedades->foto='/fotos/'.$name;


        $propiedades->save();
        return redirect()->route('propiedades.ver');
    }

    public function destroy($idProperty){
        Propiedades::where('idProperty',$idProperty)->first()->delete();
        return redirect()->route('propiedades.ver');
    }
}
