<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Pluviometry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Shinobi
use Illuminate\Database\Eloquent\Model\Permission;
use Illuminate\Database\Eloquent\Model\Role;

//DomPDF
use Barryvdh\DomPDF\Facade as PDF;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PluviometriesExport;
use App\Imports\PluviometriesImport;


class PluviometryController extends Controller
{

	    /**
     * Create a new controller instance.
     *
     * @return void
     */
        public function __construct(){

            $this->middleware('can:pluviometry.create')->only(['create', 'store']);

            $this->middleware('can:pluviometry.index')->only(['index']);

            $this->middleware('can:pluviometry.edit')->only(['edit', 'update']);

            $this->middleware('can:pluviometry.show')->only(['show']);

            $this->middleware('can:pluviometry.destroy')->only(['destroy']);

        }

        protected function validatorCreate(array $data)
        {
            return Validator::make($data, [
                'value_read' => 'required|numeric',
                'sector_id' => 'required'
            ]);
        }    


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {   
        $pluviometries = Pluviometry::orderBy('date_read', 'DESC')->limit(10)->get();
        //$pluviometries = DB::select(DB::raw("SELECT * FROM pluviometries WHERE YEAR(date_read) = '2019' and archived = 'N' ORDER BY date_read ASC"));
        $sectors = Sector::all();
        return view('pages.administration.pluviometries.index', compact('pluviometries', 'sectors'));

    }
    

    public function create()
    {
    	$sectors = sector::all();
    	return view('pages.administration.pluviometries.create', compact('sectors'));
    }


    public function store(Request $request)
    {
        $this->validatorCreate($request->all())->validate();
        try {
            $pluviometry = new Pluviometry();
            $pluviometry->date_read = $request->get('date_read');   
            $pluviometry->value_mm = (double)$request->get('value_read');
            $pluviometry->sector_id = (int)$request->get('sector_id');

            DB::beginTransaction();
            $pluviometry->save();
            DB::commit();
            session()->flash('my_message','Registro Pluviometrico Creado!');
            return redirect()->back();
            
        } catch (Exception $e) {
            session()->flash('my_error',$e->getMessage());
            DB::rollback();            
        }
    }


    public function edit(Pluviometry $pluviometry)
    {
    	$sectors= sector::all();
    	return view('pages.administration.pluviometries.edit', compact('sectors', 'pluviometry'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function update(Request $request)
        {
            $this->validatorCreate($request->all())->validate();
            try {
                $pluviometry = Pluviometry::findOrFail($request->pluviometry_id);
                $pluviometry->date_read = $request->get('date_read');
                $pluviometry->value_mm = (double)$request->get('value_read');
                $pluviometry->sector_id = (int)$request->get('sector_id');

                DB::beginTransaction();
                $pluviometry->save();
                DB::commit();
                session()->flash('my_message','Registro Pluviometrico Actualizado!');
                return redirect()->route('pluviometry.index');

            } catch (Exception $e) {
                session()->flash('my_error',$e->getMessage());
                DB::rollback();            
            }
        }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy(Pluviometry $pluviometry)
        {
            try {
                $plank = Pluviometry::find($pluviometry->id);
                DB::beginTransaction();
                $pluviometry->delete();
                DB::commit();
                session()->flash('my_message','Registro pluviometrico ('. $pluviometry->date_read .' ) Eliminado!');
                return redirect()->back();

            } catch (Exception $e) {
                session()->flash('my_error',$e->getMessage());
                DB::rollback();            
            }
        }

     //Llamado a la Vista con el Invoice del PDF
        public function pluviometriesPDF(){
            $sectors = Sector::get();
            $date = date('d-m-Y');
            $pdf = PDF::loadView('pages.administration.reports.pluviometries-pdf', compact('pluviometries', 'date'));
            return $pdf->stream('rodeo-list-'.date('Y-m-d_H:i:s').'.pdf');
        }


    //Ejecucion del Metodo que Renderiza el PDF
        public function pluviometriesExcel(){       
            return Excel::download(new PluviometriesExport, 'pluviometries-list-'.date('Y-m-d_H:i:s').'.xlsx');
        }


    //Llamado a la vista con el Formulario de la Importacion del Archivo Excel
        public function import(){
            return view('pages.administration.pluviometries.import');
        }


    //Ejecucion del metodo que realiza la importacion
        public function importExcel(Request $request){
         $file = $request->file('file');
         Excel::import(new PluviometriesImport, $file);

         session()->flash('my_message', 'pluviometrias importados Correctamente');
         return redirect()->back();
     }

    //Funcion para generar Grafico de Pluviometrias Separado por Sector
        public function pluviometryBySector ($start, $end){
        $result = DB::table('pluviometries')
                    ->join('sectors', 'sectors.id', '=', 'pluviometries.sector_id') 
                    ->select('sector_de', DB::raw('SUM(value_mm) as total'))            
                    ->whereBetween('date_read', [$start, $end])
                    ->groupBy('sector_id')
                    ->get();
        //$result=  DB::select(DB::raw("SELECT sector_id, IFNULL(SUM(value_mm),0) as total from pluviometries WHERE date_read BETWEEN '2019-05-01' AND '2019-05-31' GROUP BY sector_id"));
        return response()->json($result);
    } 

}
