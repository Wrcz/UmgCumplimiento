<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App;
use Carbon\Carbon;

class EvidenciaController extends Controller
{
  //Metodo para Eliminar empresas
  public function eliminar($idevidencia)
  {
      try {
          $Evidencia = App\evidencia::where('idevidenciacumplimiento', $idevidencia)->delete();
          return back()->with('mensaje', 'Evidencia Eliminada.');
      } catch (\Illuminate\Database\QueryException $e) {
          report($e);
          return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
      } catch (PDOException $e) {
          return back()->with('mensajeerror', 'Ocurrio un error al eliminar.');
      }
  }

   //Metodo para obtener empresaas
   public function agregar(Request $request)
   {
       try {
        $patharchivo="";
     
            if ($request->hasfile('archivo') )
            {
                $archivo = $request->file('archivo');

           
                $patharchivo=time().$archivo->getClientOriginalName();
               
                $archivo->move(public_path().'/evidencias',$patharchivo);
            }
        
           
           $nombre = $request->get('nombre');
           $observaciones = $request->get('observacionarchivo');
           $cumplimientoevidencia = $request->get('cumplimiento');
           $date = Carbon::now()->toDateTimeString();
 
            $Evidencia=new App\evidencia;
            $Evidencia->idcumplimientoempresa=$cumplimientoevidencia;
            $Evidencia->nombreevidencia=$nombre;
            $Evidencia->documentoevidencia=$patharchivo;
            $Evidencia->observacionevidencia=$observaciones;
            $Evidencia->fechacargada=$date;
           
            $Evidencia->save();

            return back()->with('mensaje', 'Evidencia Agregada correctamente!');
       } catch (\Illuminate\Database\QueryException $e) {
           dd($e);
           return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
       } catch (PDOException $e) {
        dd($e);
           return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
       }
     catch (Exception $e) {
         dd($e);
        return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
    }
   }
}
