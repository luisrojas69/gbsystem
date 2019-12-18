<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Sector;
use App\lot;
use App\Plank;
use App\Rodeo;
use App\Paddock;

class HomeController extends Controller
{	

  public function index()
  {
   $sectors= Sector::all();
   $lots= Lot::all();
   $planks= Plank::all();
   $result= DB::table('captures')
   ->join('crops', 'crops.id', '=', 'captures.crop_id')
   ->select('crops.crop_na as cultivo',
    DB::raw(
      'IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ), 0) anterior,
      IFNULL( SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END), 0) total_sembrado,
      IFNULL( SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END), 0) total_cosechado,
      IFNULL( SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END), 0) total_ajustado,
      IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ) - (SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END ) + SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END )), 0) disponible_para_corte,
      IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ), 0) disponible_para_siembra
      '))
   ->groupBy('cultivo') 
   ->get();

   $lastWells = DB::table('wells')->orderBy('id', 'desc')->take(4)->get();
   
   $lastAnimals = DB::table('animals')->orderBy('id', 'desc')->take(4)->get();

  $rodeos = Rodeo::all();

  $paddocks = Paddock::all();

   return view('pages.home', compact('sectors','lots','planks','result','lastWells', 'lastAnimals', 'rodeos', 'paddocks'));

 }

 public function getRolesTest(){
  $roles = auth()->user()->roles;
  $permissions = auth()->user()->permissions;
      //auth()->user()->givePermissionTo('edit.pages', 'create.pages', 'delete.pages');
      //auth()->user()->removeRoles('Admin');
      //auth()->user()->assignRoles('Supervisor');
      //auth()->user()->syncRoles('Admin');
      //$isEditor = auth()->user()->hasRole('admin');

      //dd($isEditor);
    return redirect()->back();
}

    //Funcion para generar Grafico de Pluviometrias Separado por Sector
public function pluviometryBySector ($start, $end){
       /* $result = DB::table('pluviometries')
                    ->join('sectors', 'sectors.id', '=', 'pluviometries.sector_id') 
                    ->select('sector_de', DB::raw('SUM(value_mm) as total'))            
                    ->whereBetween('date_read', [$start, $end])
                    ->(DB::raw('GROUP BY(MONTH(date_read))')
                    ->get();*/
                    $result=  DB::select(DB::raw("SELECT sector_id, IFNULL(SUM(value_mm),0) as total, month (date_read) from pluviometries WHERE year(date_read) = '2019' GROUP BY month (date_read), sector_id order by  month (date_read)"));
                    return response()->json($result);
                  } 
                  

  public function pluviometryAnualBySector(){
                    $result = DB::select(DB::raw("
                      SELECT sector_id,
                      IFNULL(SUM(IF(month = 'Jan', total, 0)),0) AS 'Ene',
                      IFNULL(SUM(IF(month = 'Feb', total, 0)),0) AS 'Feb',
                      IFNULL(SUM(IF(month = 'Mar', total, 0)),0) AS 'Mar',
                      IFNULL(SUM(IF(month = 'Apr', total, 0)),0) AS 'Abr',
                      IFNULL(SUM(IF(month = 'May', total, 0)),0) AS 'May',
                      IFNULL(SUM(IF(month = 'Jun', total, 0)),0) AS 'Jun',
                      IFNULL(SUM(IF(month = 'Jul', total, 0)),0) AS 'Jul',
                      IFNULL(SUM(IF(month = 'Aug', total, 0)),0) AS 'Ago',
                      IFNULL(SUM(IF(month = 'Sep', total, 0)),0) AS 'Sep',
                      IFNULL(SUM(IF(month = 'Oct', total, 0)),0) AS 'Oct',
                      IFNULL(SUM(IF(month = 'Nov', total, 0)),0) AS 'Nov',
                      IFNULL(SUM(IF(month = 'Dec', total, 0)),0) AS 'Dic',

                      IFNULL(SUM(total),0) AS total_yearly
                      FROM (SELECT sector_id, DATE_FORMAT(date_read, '%b') AS month, SUM(value_mm) as total FROM pluviometries WHERE date_read <= NOW() and date_read >= Date_add(Now(),interval - 12 month) GROUP BY DATE_FORMAT(date_read, '%m-%Y'), sector_id ORDER by sector_id asc) as sub GROUP BY sector_id"));

                    return response()->json($result);
                  }

    // Funcion para realizar conteo de Pozos segun su estatus
    public function wellsByStatus(){
      $result = DB::table('wells')
                     ->select(DB::raw('count(*) as numPozos, status'))
                     ->groupBy('status')
                     ->get();        

      return response()->json($result);
    }

        // Funcion para realizar conteo de Pozos segun su estatus
    public function wellsByType(){
      $result = DB::table('wells')
                     ->select(DB::raw('count(*) as num, type'))
                     ->groupBy('type')
                     ->get();        

      return response()->json($result);
    }


    // Funcion para realizar conteo de Pozos segun su estatus
    public function animalsByCondition(){
      $result = DB::table('animals')
                     ->select(DB::raw('count(*) as numAnimals'))
                     ->groupBy('condition')
                     ->where('rodeo_id', 1)
                     ->get();        

      return response()->json($result);
    }

}


