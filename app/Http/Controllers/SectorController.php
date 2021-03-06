<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SectorRequest;

//Shinobi
use Illuminate\Database\Eloquent\Model\Permission;
use Illuminate\Database\Eloquent\Model\Role;

//DomPDF
use Barryvdh\DomPDF\Facade as PDF;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SectorsExport;
use App\Imports\SectorsImport;

use App\Sector;


class SectorController extends Controller
{
    public function __construct(){

        $this->middleware('can:sector.create')->only(['create', 'store']);

        $this->middleware('can:sector.index')->only(['index']);

        $this->middleware('can:sector.edit')->only(['edit', 'update']);

        $this->middleware('can:sector.show')->only(['show']);

        $this->middleware('can:sector.destroy')->only(['destroy']);

    }

    
    public function index(Request $request)
    {
    	$sectors= Sector::name($request->name)->get();
    	return view('pages.administration.farming.stablishments.sectors.index', compact('sectors'));
    }

    
    public function create ()
    {
    	return view('pages.administration.farming.stablishments.sectors.create');   
    }


    public function show (Sector $sector)
    {
    	return view('pages.administration.farming.stablishments.sectors.show', compact('sector'));
    }

    public function store(SectorRequest $request)
    {

     try {
        $sector = new Sector;
        $sector->sector_co = $request->sector_co;
        $sector->sector_de = $request->sector_de;

        DB::beginTransaction();
        $sector->save();
        DB::commit();
        session()->flash('my_message', 'Sector Creado Correctamente');
        return redirect()->back();
    } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());
        DB::rollback();
    }

}

public function destroy(Sector $sector){
   try{
      $sector =Sector::find($sector->id);
      DB::beginTransaction();
      $sector->delete();
      DB::commit();
      session()->flash('my_message', 'Sector Eliminado Correctamente');
      return redirect()->back();
  }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}

public function edit(Sector $sector){
   return view('pages.administration.farming.stablishments.sectors.edit', compact('sector'));
}


public function update(Request $request){
   try{
      $sector = Sector::findOrFail($request->sector_id);
      $sector->sector_co = $request->get('sector_co');
      $sector->sector_de = $request->get('sector_de');
      DB::beginTransaction();
      $sector->save();
      DB::commit();
      session()->flash('my_message', 'Sector Modificado Correctamente');
      return redirect('establishments\sector');
  }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}


public function showPluviometry ($id){
  $result=  DB::select(DB::raw("SELECT IFNULL(SUM(value_mm),0) as total,

    IFNULL((SELECT SUM(value_mm) from pluviometries where year(date_read) = year(NOW()) and sector_id=$id),0) as total_anio_actual,

    IFNULL((SELECT SUM(value_mm) from pluviometries where year(date_read) = year(NOW())-1 and sector_id=$id),0) as total_anio_pasado,

    IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) = month(NOW())-1 and sector_id=$id),0) as mes_pasado,

    IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) = 
    if(month(NOW()) = 12, 1,month(NOW())+ 1)
    and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes1,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 11, 1,if(month(NOW()) = 12, 2,month(NOW()) + 2 ))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes2,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 10, 1,if(month(NOW()) = 11, 2,if(month(NOW()) = 12, 3,month(NOW()) + 3 ) ))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes3,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 9, 1,if(month(NOW()) = 10, 2,if(month(NOW()) = 11, 2,
if(month(NOW()) = 12, 4,month(NOW()) + 4 ))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes4,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 8, 1,if(month(NOW()) = 9, 2,if(month(NOW()) = 10, 3,
if(month(NOW()) = 11, 4,if(month(NOW()) = 12, 5,month(NOW()) + 5 )))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes5,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 7, 1,if(month(NOW()) = 8, 8,if(month(NOW()) = 9, 3,
if(month(NOW()) = 10, 4,if(month(NOW()) = 11, 5,if(month(NOW()) = 12, 6,month(NOW()) + 6 ))))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes6,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 6, 1,if(month(NOW()) = 7, 2,if(month(NOW()) = 8, 3,
if(month(NOW()) = 9, 4,if(month(NOW()) = 10, 5,if(month(NOW()) = 11, 6,
if(month(NOW()) = 12, 7,month(NOW()) + 7) ) )) )))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes7,


IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 5, 1,if(month(NOW()) = 6, 2,if(month(NOW()) = 7, 3,
if(month(NOW()) = 8, 4,if(month(NOW()) = 9, 5,if(month(NOW()) = 10, 6,
if(month(NOW()) = 11, 7,if(month(NOW()) = 12, 8,month(NOW()) + 8 ))))))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes8,


IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 4, 1,if(month(NOW()) = 5, 2,if(month(NOW()) = 6, 3,
if(month(NOW()) = 7, 7,if(month(NOW()) = 8, 5,if(month(NOW()) = 9, 6,
if(month(NOW()) = 10, 7,if(month(NOW()) = 11, 8,
if(month(NOW()) = 12, 9,month(NOW()) + 9 )))))))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes9,


IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) = 
if(month(NOW()) = 3, 1,if(month(NOW()) = 4, 2,if(month(NOW()) = 5, 3,
if(month(NOW()) = 6, 4,if(month(NOW()) = 7, 5,if(month(NOW()) = 8, 6,
if(month(NOW()) = 9, 7,if(month(NOW()) = 10, 8,if(month(NOW()) = 11, 9,
if(month(NOW()) = 12, 10,month(NOW()) + 10 ))))))))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes10,


IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) =
if(month(NOW()) = 2, 1,if(month(NOW()) = 3, 2,if(month(NOW()) = 4, 3,
if(month(NOW()) = 5, 4,if(month(NOW()) = 6, 5,if(month(NOW()) = 7, 6,
if(month(NOW()) = 8, 7,if(month(NOW()) = 9, 8,if(month(NOW()) = 10, 9,
if(month(NOW()) = 11, 10,if(month(NOW()) = 12, 11,month(NOW()) + 11 )))))))))))
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes11,

IFNULL((SELECT SUM(value_mm) from pluviometries where month(date_read) = month(NOW())
and sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
),0) as Mes12,
month(NOW()) as posicion

from pluviometries
where sector_id = $id and date_read >= date_add(date_add(NOW(), INTERVAL -11 MONTH), INTERVAL - (DAY(NOW())-1) DAY)  and NOW() >= date_read 
"));

return response()->json($result);
}

public function details(Sector $id){
    return view('pages.administration.farming.stablishments.sectors_details', compact('id'));
    //return $id->id;
}


    //Llamado a la Vista con el Invoice del PDF
public function sectorsPDF(){
    $sectors = Sector::get();
    $date = date('d-m-Y');
    $pdf = PDF::loadView('pages.administration.reports.sectors-pdf', compact('sectors', 'date'));
    return $pdf->stream('rodeo-list-'.date('Y-m-d_H:i:s').'.pdf');
}


    //Ejecucion del Metodo que genera el Excel
public function sectorsExcel(){       
    return Excel::download(new SectorsExport, 'sectors-list-'.date('Y-m-d_H:i:s').'.xlsx');
}


    //Llamado a la vista con el Formulario de la Importacion del Archivo Excel
public function import(){
    return view('pages.administration.farming.stablishments.sectors.import');
}


    //Ejecucion del metodo que realiza la importacion
public function importExcel(Request $request){
 $file = $request->file('file');
 Excel::import(new SectorsImport, $file);

 session()->flash('my_message', 'Sectores importados Correctamente');
 return redirect()->back();
}
}
