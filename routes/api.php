<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('states',[ApiController::class,'getAllStates']);
Route::get('states/{StateId}',[ApiController::class,'getState']);
Route::post('states',[ApiController::class,'createState']);
Route::put('states/{StateId}',[ApiController::class,'updateState']);
Route::delete('states/{StateId}',[ApiController::class,'deleteState']);

Route::get('officers',[ApiController::class,'getAllOfficers']);
Route::get('officers/{OfficerId}',[ApiController::class,'getOfficer']);
Route::post('officers',[ApiController::class,'createOfficer']);
Route::put('officers/{OfficerId}',[ApiController::class,'updateOfficer']);
Route::delete('officers/{OfficerId}',[ApiController::class,'deleteOfficer']);
Route::get('officer/report/{reportId}',[ApiController::class,'getOfficerAssigned']);  

Route::get('categories',[ApiController::class,'getAllCategory']);
Route::get('categories/{CategoryId}',[ApiController::class,'getCategory']);
Route::post('categories',[ApiController::class,'createCategory']);
Route::put('categories/{CategoryId}',[ApiController::class,'updateCategory']);
Route::delete('categories/{CategoryId}',[ApiController::class,'deleteCategory']);

Route::get('addresses',[ApiController::class,'getAllAddress']);
Route::get('addresses/{AddressID}',[ApiController::class,'getAddress']);
Route::post('addresses',[ApiController::class,'createAddress']);
Route::put('addresses/{AddressID}',[ApiController::class,'updateAddress']);
Route::delete('addresses/{AddressID}',[ApiController::class,'deleteAddress']);

Route::put('addresses/user_/{UserID}',[ApiController::class,'updateAddressforUser']);
Route::get('addresses/user_/{UserID}',[ApiController::class,'getAddressbyUserID']);

Route::get('user_',[ApiController::class,'getAllUser']);
Route::get('user_/{UserId}',[ApiController::class,'getUser']);
Route::post('user_',[ApiController::class,'createUser']);
Route::put('user_/{UserId}',[ApiController::class,'updateUser']);
Route::delete('user_/{UserId}',[ApiController::class,'deleteUser']);

Route::get('user_/email/{Email}',[ApiController::class,'getUserByEmail']);
Route::post('user_/register',[ApiController::class,'register']);

Route::post('address/user',[ApiController::class,'createAddressWithUser']);

Route::get('reports',[ApiController::class,'getAllReport']);
Route::get('reports/{ReportId}',[ApiController::class,'getReport']);
Route::post('reports',[ApiController::class,'createReport']);
Route::put('reports/{ReportId}',[ApiController::class,'updateReport']);
Route::delete('reports/{ReportId}',[ApiController::class,'deleteReport']);

Route::get('count/reports',[ApiController::class,'getReportCount']);
Route::get('count/reports/state',[ApiController::class,'countState']);
Route::get('count/reports/category',[ApiController::class,'countCategory']);

Route::post('reports/guest',[ApiController::class,'postReportasGuest']);

Route::get('reports/user/{UserId}',[ApiController::class,'getReportForUser']);

Route::get('assignedreport/{officerId}',[ApiController::class,'getReportAssigned']);


Route::get('responses',[ApiController::class,'getAllResponse']);
Route::get('responses/{ResponseId}',[ApiController::class,'getResponse']);
Route::post('responses',[ApiController::class,'createResponse']);
Route::put('responses',[ApiController::class,'updateResponse']);
Route::delete('responses/{ResponseId}',[ApiController::class,'deleteResponse']);

Route::get('report/responses',[ApiController::class,'getResponseForReport']);

Route::get('designations',[ApiController::class,'getAllDesignation']);
Route::get('designations/{DesignationId}',[ApiController::class,'getDesignation']);
Route::post('designations',[ApiController::class,'createDesignation']);
Route::put('designations/{DesignationId}',[ApiController::class,'updateDesignation']);
Route::delete('designations/{DesignationId}',[ApiController::class,'deleteDesignation']);

Route::post('upload',[ApiController::class,'uploadFile']);
Route::get('export/report',[ApiController::class,'exportReport']);