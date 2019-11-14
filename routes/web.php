<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
// 	$sectors= App\Sector::all();
//     return view('pages.home', compact('sectors'));
// });

use Illuminate\Http\Request;

//Auths
Auth::routes();


//Home
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index');


//Grupo de Rutas con el Middleware Auth ( para forzar el inicio d Sesion)
Route::middleware(['auth'])->group(function () {

	
	//Usuarios
	Route::resource('administration/user','UserController')->except(['create']);

	//Roles
	Route::resource('administration/role','RoleController');


	//Rodeos
	Route::resource('animals/rodeo','RodeoController')->except(['show', 'edit', 'create']);

	Route::get ('/animals/movetorodeo/{id}', 'AnimalController@MoveToRodeoCall')->name('movetorodeo');

	Route::get ('/animals/updaterodeo/{animal_id}/{rodeo_id}', 'AnimalController@MoveToRodeoExecute')->name('update_rodeo');

	Route::get ('/animals/multimovetorodeo', 'AnimalController@MultiMoveToRodeoCall')->name('multimovetorodeo');

	Route::post('multimovetorodeo', 'AnimalController@MultiMoveToRodeoExecute');

	Route::get ('/report/rodeos-pdf', 'RodeoController@rodeosPDF')->name('rodeos.pdf');

	Route::get ('/report/rodeos-excel', 'RodeoController@rodeosExcel')->name('rodeos.excel');


	//Pluviometria

	Route::resource('pluviometry', 'PluviometryController');


	//Sectors
	Route::get('establishments/sector/{id}/pluviometry', 'SectorController@showPluviometry');

	Route::get('establishments/sector/{id}/details', 'SectorController@details');

	Route::resource('establishments/sector', 'SectorController');

	Route::get ('/report/sectors-pdf', 'SectorController@sectorsPDF')->name('sectors.pdf');

	Route::get ('/report/sectors-excel', 'SectorController@sectorsExcel')->name('sectors.excel');

	Route::get('/sector/import', 'SectorController@import');

	Route::post ('/sector/import', 'SectorController@importExcel')->name('sectors.import.excel');


	//Lots
	Route::resource('establishments/lot', 'LotController');

	Route::get('/lot/import', 'LotController@import');

	Route::post ('/lot/import', 'LotController@importExcel')->name('lots.import.excel');


	//Planks
	Route::resource('establishments/plank', 'PlankController');


	//Crops
	Route::resource('supplies/crop', 'CropController')->except(['create','show', 'edit']);

	//Varieties
	Route::resource('supplies/variety', 'VarietyController');

	//Fertilzer
	//Route::resource('supplies/fertilizer', 'FertilizerController');

	//Activities
	Route::resource('activity', 'ActivityController')->except(['create','edit', 'show']);


	//Captures
	Route::resource('capture', 'CaptureController');

	//Species
	Route::resource('animals/specie', 'SpecieController')->except(['create','show', 'edit']);


	//Breeds
	Route::resource('animals/breed', 'BreedController');


	//Paddocks
	Route::resource('animals/paddock', 'PaddockController')->except(['show', 'edit']);

	Route::get ('/animals/multimovetopaddock', 'AnimalController@MultiMoveToPaddockCall')->name('multimovetopaddock');

	Route::post('multimovetopaddock', 'AnimalController@MultiMoveToPaddockExecute');

	Route::get ('/animals/updatepaddock/{animal_id}/{paddock_id}', 'AnimalController@MoveToPaddockExecute')->name('update_paddock');			



	//Weighings
	Route::resource('animals/weighing', 'WeighingController');

	Route::resource('animals/weighing','WeighingController');

	Route::get ('/animals/add_weighing/{id}', 'WeighingController@create')->name('add_weighing');

	Route::get ('/animals/new_weighing/', 'WeighingController@new_weighing')->name('new_weighing');

	Route::get('animal/{id}/getweighins', 'AnimalController@getWeighins');


	//Animals

	Route::resource('animals/animal', 'AnimalController');

	Route::get ('/report/animals-pdf', 'AnimalController@animalsPDF')->name('animals.pdf');

	Route::get ('/report/animals-excel', 'AnimalController@animalsExcel')->name('animals.excel');

});//Fin Grupo de Rutas con el Middleware Auth ( para forzar el inicio d Sesion)
