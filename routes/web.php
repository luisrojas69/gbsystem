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

Route::get('/home/pluviometryBySector/{start}/{end}', 'HomeController@pluviometryBySector');

Route::get('/home/pluviometryAnualBySector', 'HomeController@pluviometryAnualBySector');

Route::get('/home/wellsByStatus', 'HomeController@wellsByStatus');

Route::get('/home/wellsByType', 'HomeController@wellsByType');

Route::get('/example', function () {
    return view('pages.administration.pluviometries.example_bar_graph');
});




//Grupo de Rutas con el Middleware Auth ( para forzar el inicio d Sesion)
Route::middleware(['auth'])->group(function () {

	
	
	//Usuarios
	Route::resource('administration/user','UserController')->except(['create']);

	Route::get ('/report/users-excel', 'UserController@usersExcel')->name('users.excel');


	//Roles
	Route::resource('administration/role','RoleController');


	//Pozos
	Route::resource('well','WellController')->except(['create', 'edit']);;

	Route::get ('/report/wells-pdf', 'WellController@wellsPDF')->name('wells.pdf');

	Route::get ('/report/wells-excel', 'WellController@wellsExcel')->name('wells.excel');



	//Horometros de Pozos
	Route::resource('/wells/horometer','HorometerController')->except(['show', 'create', 'edit']);

	Route::get ('/horometer/HorometersByWells/{id}', 'HorometerController@HorometersByWells');

	Route::get ('/report/horometers-excel', 'HorometerController@horometersExcel')->name('horometers.excel');


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

	Route::get('/pluviometries/pluviometryBySector/{start}/{end}', 'PluviometryController@pluviometryBySector');


	//Sectors
	Route::get('establishments/sector/{id}/pluviometry', 'SectorController@showPluviometry');

	Route::get('establishments/sector/{id}/details', 'SectorController@details');

	Route::resource('establishments/sector', 'SectorController');

	Route::get ('/report/sectors-pdf', 'SectorController@sectorsPDF')->name('sectors.pdf');

	Route::get ('/report/sectors-excel', 'SectorController@sectorsExcel')->name('sectors.excel');

	Route::get('/sectors/import', 'SectorController@import')->name('sectors.import');;

	Route::post ('/sectors/import', 'SectorController@importExcel')->name('sectors.import.excel');


	//Lots
	Route::resource('establishments/lot', 'LotController');

	Route::get ('/report/lots-excel', 'LotController@lotsExcel')->name('lots.excel');

	Route::get('/lots/import', 'LotController@import')->name('lots.import');;

	Route::post ('/lots/import', 'LotController@importExcel')->name('lots.import.excel');


	//Planks
	Route::resource('establishments/plank', 'PlankController');

	Route::get ('/report/planks-excel', 'PlankController@planksExcel')->name('planks.excel');

	Route::get('/import/planks', 'PlankController@import')->name('planks.import');
	
	Route::post ('/import/planks', 'PlankController@importExcel')->name('planks.import.excel');


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


	//Lots Animals
	Route::resource('animals/lotsAnimals', 'LotAnimalController')->except(['create', 'edit']);;

	Route::get ('/report/lots-animals-pdf', 'LotAnimalController@lotsAnimalsPDF')->name('lots-animals.pdf');

	Route::get ('/report/lots-animals-excel', 'LotAnimalController@lotsAnimalsExcel')->name('lots-animals.excel');


	//Animals
	Route::resource('animals/animal', 'AnimalController');

	Route::get ('/report/animals-pdf', 'AnimalController@animalsPDF')->name('animals.pdf');

	Route::get ('/report/animals-excel', 'AnimalController@animalsExcel')->name('animals.excel');




	//Reports
	//Route::get ('/report/general', 'ReportController@animalsPDF')->name('reports.pdf');


});//Fin Grupo de Rutas con el Middleware Auth ( para forzar el inicio d Sesion)
