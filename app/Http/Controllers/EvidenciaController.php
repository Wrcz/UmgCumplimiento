<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App;
use Carbon\Carbon;

class EvidenciaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
      }

      
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
       /*
            $validator = Validator::make($request->all(), [
                'file' => 'required|max:3145730', // 3GB
                'nombre' => 'required|numeric'
            ]);
        */
    
       try {
        

       // dd($request->hasfile('archivo'));
        //dd(phpinfo()); 

       // $path = Storage::putFile('archivo', $request->file('archivo'));
        //$disk = Storage::disk('local');
      //  $disk->put('prueba.pdf', fopen($request->get('archivo'), 'r+'));

        //dd($disk);
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
    catch (PostTooLargeException $e){
        dd($e);
        return back()->with('mensajeerror', 'Ocurrio un error al obtener los datos.');
    }

   }
}
