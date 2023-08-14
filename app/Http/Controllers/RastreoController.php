<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rastreo;


class RastreoController extends Controller
{
    public function index(Request $request){
        $busqueda = $request->busqueda;
        $rastreo = Rastreo::paginate(12);
        return view('rastreo', compact('rastreo','busqueda'));
    }
    public function filtro_name(Request $request){
        $busqueda = $request->busqueda;
        if($request->name == ''){
            $rastreo = Rastreo::paginate(12);
        }else{
            $rastreo = Rastreo::where('name', $request->name)->paginate(12);
        }
        return view('rastreo', compact('rastreo', 'busqueda'));
    }

    public function store(Request $request)
    {
        $propiedades = new  Rastreo();
        $propiedades->datesale = $request->datesale;
        $propiedades->name = $request->name;
        $propiedades->value = $request->value;
        $propiedades->tax = $request->tax;
        $propiedades->idProperty = $request->idProperty;

        $propiedades->save();
        return redirect()->route('rastreo.ver');
    }

    public function update(Request $request){
    
        $propiedades = Rastreo::find($request->idPropertyTrace); 
        $propiedades->datesale = $request->datesale;
        $propiedades->name = $request->name;
        $propiedades->value = $request->value;
        $propiedades->tax = $request->tax;
        $propiedades->idProperty = $request->idProperty;

        $propiedades->save();
        return redirect()->route('rastreo.ver');
    }

    public function destroy($idPropertyTrace){
        Rastreo::where('idPropertyTrace',$idPropertyTrace)->first()->delete();
        return redirect()->route('rastreo.ver');
    }
}
