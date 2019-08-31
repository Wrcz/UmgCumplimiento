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
        
          $archivo = $request->get('archivo');
           $nombre = $request->get('nombre');
           $observaciones = $request->get('observaciones');
           $cumplimientoevidencia = $request->get('cumplimiento');
           
            $date = Carbon::now()->toDateTimeString();
 
            $Evidencia=new App\evidencia;
            $Evidencia->idcumplimientoempresa=$cumplimientoevidencia;
            $Evidencia->nombreevidencia=$nombre;
            $Evidencia->documentoevidencia=null;
            $Evidencia->observacionevidencia=$observaciones;
            $Evidencia->fechacargada=$date;
           
            $Evidencia->save();
        
       } catch (\Illuminate\Database\QueryException $e) {
           dd($e);
           return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
       } catch (PDOException $e) {
           return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
       }
   }
}
