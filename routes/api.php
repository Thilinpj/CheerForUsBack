<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('articleStore','Articles@articleStore');
 Route::get('articles',function(Request $request){
     $data=DB::table('admin_articles')->get();
     return response()->json($data);
 });

 Route::get('deleteArticles/{id}', 'Articles@articleDelete');
Route::get('articleDetails/{id}','Articles@getArticle');

 Route::post('customer','UserControl@customerSignUp');
 Route::post('admin','UserControl@adminSignUp');
 Route::post('institute','UserControl@instituteSignUp');
Route::post('login','UserControl@login');