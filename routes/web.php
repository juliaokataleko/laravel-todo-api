<?php

use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\Console\Input\Input as InputInput;

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



Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/profile/edit', 'UserController@edit')->name('edit-profile');
Route::post('/profile/edit', 'UserController@update')->name('update-profile');

Route::post('/profile/change-password', 'UserController@changePassword')->name('password_update');

Route::get('/profile/photo', 'UserController@photoEdit')->name('edit-profile-photo');
Route::post('/profile/photo', 'UserController@updatePhoto')->name('update-profile-photo');

Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'admin', 'verified']], function(){
    
    
});

Route::get('/todos', 'TodoController@index')->name('todos');
Route::post('/todo/store', 'TodoController@store')->name('store');
Route::get('/todo/delete/{id}', 'TodoController@destroy')->name('destroy');

