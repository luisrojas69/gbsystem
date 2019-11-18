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

	Route::resource('pluviometry', 'PluviometryController')->except(['create','show', 'edit']);

	Route::get ('/report/pluviometries-pdf', 'PluviometryController@pluviometriesPDF')->name('pluviometries.pdf');

Route::get ('/report/pluviometries-excel', 'PluviometryController@pluviometriesExcel')->name('pluviometries.excel');

	Route::get('/pluviometries/import', 'PluviometryController@import');

	Route::post ('/pluviometries/import', 'PluviometryController@importExcel')->name('pluviometries.import.excel');






	//Sectors
	Route::get('establishments/sector/{id}/pluviometry', 'SectorController@showPluviometry');

	Route::get('establishments/sector/{id}/details', 'SectorController@details');

	Route::resource('establishments/sector', 'SectorController');

	Route::get ('/report/sectors-pdf', 'SectorController@sectorsPDF')->name('sectors.pdf');

	Route::get ('/report/sectors-excel', 'SectorController@sectorsExcel')->name('sectors.excel');

<<<<<<< HEAD
	Route::get('/sectors/import', 'SectorController@import')->name('sectors.import');;

	Route::post ('/sectors/import', 'SectorController@importExcel')->name('sectors.import.excel');
=======
	Route::get('/import/sectors', 'SectorController@import')->name('sectors.import');

	Route::post ('/import/sector', 'SectorController@importExcel')->name('sectors.import.excel');
>>>>>>> 67d75cf1496c995f4502dccc78577506dc012b89


	//Lots
	Route::resource('establishments/lot', 'LotController');

<<<<<<< HEAD
	Route::get('/lots/import', 'LotController@import')->name('lots.import');;

	Route::post ('/lots/import', 'LotController@importExcel')->name('lots.import.excel');
=======
	Route::get('/import/lots', 'LotController@import')->name('lots.import');

	Route::post ('/import/lot', 'LotController@importExcel')->name('lots.import.excel');
>>>>>>> 67d75cf1496c995f4502dccc78577506dc012b89


	//Planks
	Route::resource('establishments/plank', 'PlankController');

	Route::get('/import/planks', 'PlankController@import')->name('planks.import');
<<<<<<< HEAD
	
	Route::post ('/import/planks', 'PlankController@importExcel')->name('planks.import.excel');

=======

	Route::post ('/import/planks', 'PlankController@importExcel')->name('planks.import.excel');


>>>>>>> 67d75cf1496c995f4502dccc78577506dc012b89

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
