<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Specie;
use App\Breed;
use App\Paddock;
use App\Rodeo;
use App\LotAnimal;
use App\Weighing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Shinobi
use Illuminate\Database\Eloquent\Model\Permission;
use Illuminate\Database\Eloquent\Model\Role;

//DomPDF
use Barryvdh\DomPDF\Facade as PDF;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnimalsExport;

class AnimalController extends Controller
{
    
        public function __construct(){
      
        $this->middleware('can:animal.create')->only(['create', 'store']);

        $this->middleware('can:animal.index')->only(['index']);

        $this->middleware('can:animal.edit')->only(['edit', 'update']);

        $this->middleware('can:animal.show')->only(['show']);

        $this->middleware('can:animal.destroy')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $animals_active=Animal::name($request->name)->where('rodeo_id', '=', 1)->paginate(10);
        //$animals_active = Animal::where('rodeo_id', '=', 1)->get();
        $animals_inactive = Animal::where('rodeo_id', '!=', 1)->paginate(10);
        $species = Specie::select('id', 'specie_de')->orderBy('id', 'asc')->get();
        $breeds = Breed::all();
        $paddocks = Paddock::all();
        $rodeos = Rodeo::all();
        $lotsAnimals = LotAnimal::All();
        return view('pages.administration.ganaderia.animals.index', compact('species','breeds', 'paddocks', 'rodeos', 'lotsAnimals', 'animals_active', 'animals_inactive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::all();
        $breeds = Breed::all();
        $paddocks = Paddock::all();
        $rodeos = Rodeo::all();
        $lotsAnimals = LotAnimal::All();
        return view('pages.administration.ganaderia.animals.create', compact('species','breeds', 'paddocks', 'rodeos', 'lotsAnimals'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $animal = new Animal;
            $animal->animal_cod = $request->animal_cod;
            $animal->animal_na = $request->animal_na;
            $animal->animal_col = $request->animal_col;
            $animal->gender = $request->gender;
            $animal->lot_animal_id = $request->lot_animal_id;
            $animal->breed_id = $request->breed_id;
            $animal->date_in = $request->date_in;
            $animal->weight_in = $request->weight_in;
            $animal->condition = $request->condition;
            $animal->paddock_id = $request->paddock_id;
            $animal->rodeo_id = $request->rodeo_id;
            $animal->comment = $request->comment;
            //dd($animal);          
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash('my_message','Animal Registrado Correctamente');
            return redirect ('animals/animal');           
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {   
        $paddocks = Paddock::where("id", "!=", $animal->paddock_id)->get();
        $rodeos = Rodeo::where("id","!=",$animal->rodeo_id)->get();
        $species = Specie::where("id","!=",$animal->specie_id)->get();
        $breeds = Breed::where("id","!=",$animal->breed_id)->get();
        //Determinamos si el Animal ha Tenido mas pesajes luego de haber ingresado
        if((Weighing::where("animal_id", $animal->id )->count() > 0) ){
            $query=Weighing::where("animal_id", $animal->id )->orderBy('id', 'DESC')->first();
            $weight=$query->weight;
        }else{
            $weight=$animal->weight_in;
        }
        return view('pages.administration.ganaderia.animals.show', compact('animal', 'rodeos', 'paddocks', 'species','breeds', 'weight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       //dd($request->all());

        try {
            $animal = Animal::findOrFail($request->animal_id);
            $animal->animal_cod = $request->animal_cod;
            $animal->animal_na = $request->animal_na;
            $animal->animal_col = $request->animal_col;
            $animal->gender = $request->gender;
            $animal->lot_animal_id = $request->lot_animal_id;
            $animal->breed_id = $request->breed_id;
            $animal->date_in = $request->date_in;
            $animal->weight_in = $request->weight_in;
            $animal->condition = $request->condition;
            $animal->paddock_id = $request->paddock_id;
            $animal->rodeo_id = $request->rodeo_id;
            $animal->comment = $request->comment;
            //dd($animal);          
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash('my_message','Animal Editado Correctamente');
            return redirect()->back();           
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal = Animal::find($animal->id);
        try {
            DB::beginTransaction();
            $animal->delete();
            DB::commit();
            Session()->flash('my_message', 'Animal Eliminado Correctamente');
            return redirect('animals/animal');
        } catch (Exception $e) {
            Session()->flash('my_error', $e->getMessage());
        }
    }

    public function MoveToRodeoCall($id)
    {
        $animal = Animal::find($id);
        $rodeos = Rodeo::where("id","!=",$animal->rodeo_id)->get();
        return view('pages.administration.ganaderia.animals.move', compact('animal', 'rodeos'));
    }

    public function MoveToRodeoExecute($animal_id, $rodeo_id)
    {
        try {
            $animal = Animal::find($animal_id);
            $animal->rodeo_id = $rodeo_id;
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash("my_message", "El Animal: ".$animal->animal_na.", fue movido al Rodeo de Animales: ".$animal->rodeo->rodeo_na);
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash("my_error", $e->getMessage());
        }   
    }


     public function MoveToPaddockExecute($animal_id, $paddock_id)
    {
        try {
            $animal = Animal::find($animal_id);
            $animal->paddock_id = $paddock_id;
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash("my_message", "El Animal: ".$animal->animal_na.", fue movido al Potrero de Animales: ".$animal->paddock->paddock_na);
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash("my_error", $e->getMessage());
        }   
    }

    //Movimineto de Ganado por Lote a Nuevos Rodeos
    
    public function MultiMoveToRodeoCall()
    {
        $animals = Animal::all();
        $rodeos = Rodeo::all();
        return view('pages.administration.ganaderia.animals.move_multiple_rodeo', compact('animals', 'rodeos'));
    }


    public function MultiMoveToRodeoExecute(Request $request)
    {
        $ids = $request->ids;
        $rodeo_id =$request->rodeo_id;
        $rodeo = Rodeo::find($rodeo_id);

        if (is_array($ids) and !is_null($rodeo_id)) 
        {
            try {   
            DB::beginTransaction();
            Animal::whereIn('id', $ids)->update(['rodeo_id' => $rodeo_id]);
            DB::commit();
            session()->flash('my_message','Animales Movidos con exito al Rodeo de Animales: '.$rodeo->rodeo_na);
            return redirect()->back();       
            } catch (Exception $e) {
                session()->flash('my_error',$e->getMessage());
                DB::rollback();            
            }
        }
         session()->flash('my_error','Seleccione al Menos un Animal y un Rodeo');
         return redirect()->back()->withInput();
    }
    //FIN Movimineto de Ganado por Lote a Nuevos Rodeos
    

    //Movimineto de Ganado por Lote a Nuevos Potreros 
    public function MultiMoveToPaddockCall()
    {
        $animals = Animal::all();
        $paddocks = Paddock::all();
        return view('pages.administration.ganaderia.animals.move_multiple_paddock', compact('animals', 'paddocks'));
    }

        
    public function MultiMoveToPaddockExecute(Request $request)
    {
        $ids = $request->ids;
        $paddock_id =$request->paddock_id;
        $paddock = Paddock::find($paddock_id);

        if (is_array($ids) and !is_null($paddock_id)) 
        {
            try {   
            DB::beginTransaction();
            Animal::whereIn('id', $ids)->update(['paddock_id' => $paddock_id]);
            DB::commit();
            session()->flash('my_message','Animales Movidos con exito al Potrero de Animales: '.$paddock->paddock_na);
            return redirect()->back();       
            } catch (Exception $e) {
                session()->flash('my_error',$e->getMessage());
                DB::rollback();            
            }
        }
         session()->flash('my_error','Seleccione al Menos un Animal y un Potrero');
         return redirect()->back()->withInput();
    }
    //FIN Movimineto de Ganado por Lote a Nuevos Potreros



    //Funcion para Generar Reporte de Animales Activos en PDF
     public function animalsPDF(){
        $animals_active = Animal::where('rodeo_id', '=', 1)->get();
        $animals_inactive = Animal::where('rodeo_id', '!=', 1)->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pages.administration.reports.animals-pdf', compact('animals_active', 'animals_inactive', 'date'));
        return $pdf->download('animals-list-'.date('Y-m-d_H:i:s').'.pdf');
        //return view('pages.administration.reports.rodeos-pdf', compact('rodeos', 'date'));
    }

    //Funcion para Generar Reporte de Animales Activos en PDF
     public function actAnimalsPDF($id){
        $date = date('d-m-Y');
        $animal = Animal::findOrFail($id);
        $pdf = PDF::loadView('pages.administration.reports.act-animals-pdf', compact('animal', 'date'));
        return $pdf->download('acta-de-defuncion-'.date('Y-m-d_H:i:s').'.pdf');
        //return view('pages.administration.reports.rodeos-pdf', compact('rodeos', 'date'));
    }




    //Funcion para Generar Reporte de Animales Activos en Excel
    public function animalsExcel(){
       return Excel::download(new AnimalsExport, 'animal-list-'.date('Y-m-d_H:i:s').'.xlsx');
    }



    public function getWeighins($id){
        $weighings= DB::select(DB::raw("SELECT `date_read` as date, `weight` as weight FROM `weighings` WHERE animal_id = ".$id." ORDER BY `date_read` ASC"));
        
        //$weighings = Weighing::where("animal_id", $id)->pluck('weight');
        return response()->json($weighings);
    }
            
}
