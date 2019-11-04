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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index');

Route::get('sector/{id}/pluviometry', 'SectorController@showPluviometry');

Route::get('sector/{id}/details', 'SectorController@details');

Route::resource('establishments/sector', 'SectorController');

Route::resource('establishments/lot', 'LotController');

Route::resource('establishments/plank', 'PlankController');

Route::resource('supplies/crop', 'CropController');

Route::resource('supplies/variety', 'VarietyController');

//Route::resource('supplies/fertilizer', 'FertilizerController');

Route::resource('activity', 'ActivityController');

Route::resource('capture', 'CaptureController');

Route::resource('pluviometry', 'PluviometryController');

Route::resource('animals/specie', 'SpecieController');

Route::resource('animals/breed', 'BreedController');

Route::resource('animals/paddock', 'PaddockController');

Route::resource('animals/weighing', 'WeighingController');

Route::resource('animals/animal', 'AnimalController');

Route::resource('animals/rodeo','RodeoController');

Route::resource('animals/weighing','WeighingController');


Route::get ('/animals/movetorodeo/{id}', 'AnimalController@MoveToRodeoCall')->name('movetorodeo');

Route::get ('/animals/updaterodeo/{animal_id}/{rodeo_id}', 
			'AnimalController@MoveToRodeoExecute')
			->name('update_rodeo');

Route::get ('/animals/updatepaddock/{animal_id}/{paddock_id}', 
			'AnimalController@MoveToPaddockExecute')
			->name('update_paddock');			

Route::get ('/animals/multimovetorodeo', 'AnimalController@MultiMoveToRodeoCall')->name('multimovetorodeo');

Route::post('multimovetorodeo', 'AnimalController@MultiMoveToRodeoExecute');

Route::get ('/animals/multimovetopaddock', 'AnimalController@MultiMoveToPaddockCall')->name('multimovetopaddock');

Route::post('multimovetopaddock', 'AnimalController@MultiMoveToPaddockExecute');

Route::get ('/animals/add_weighing/{id}', 'WeighingController@create')->name('add_weighing');

Route::get ('/animals/new_weighing/', 'WeighingController@new_weighing')->name('new_weighing');

Route::get ('/report/rodeos', 'RodeoController@rodeosPDF')->name('rodeos.pdf');

//Route::post ('/reportajax', 'ReportController@show');


