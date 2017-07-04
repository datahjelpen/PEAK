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

Auth::routes();

Route::prefix('admin')->group(function () {

	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

	Route::prefix('builder')->group(function () {

		Route::resource('type', 'Admin\Object\TypeController', ['except' => [ 'index', 'show' ], 'as' => 'object']);
		Route::resource('types', 'Admin\Object\TypeController', ['only' => [ 'index' ], 'as' => 'object']);

		Route::prefix('{type}')->group(function () {
			Route::resource('taxonomy', 'Admin\Object\TaxonomyController', ['except' => [ 'index', 'show' ], 'as' => 'object']);
			Route::resource('taxonomies', 'Admin\Object\TaxonomyController', ['only' => [ 'index' ], 'as' => 'object']);
			// Route::resource('object_tag',      'ObjectTagController',      ['except' => [ 'show' ]]);
			// Route::resource('object',          'ObjectController',         ['except' => [ 'show' ]]);
		});

	});

	Route::get('oauth-dashboard', 'Admin\DashboardController@oauth')->name('oauth-dashboard');
});

Route::get('/', function () {
	return view('welcome', compact('types'));
})->name('frontpage');

Route::prefix('{type}')->group(function () {
	Route::get('/', 'Object\TypeController@show')->name('object.type.show');
	Route::get('{taxonomy}', 'Object\TaxonomyController@show')->name('object.taxonomy.show');
	// Route::resource('object_category', 'ObjectCategoryController', ['only' => [ 'index', 'show' ]]);
	// Route::resource('object_tag',      'ObjectTagController',      ['only' => [ 'index', 'show' ]]);
	// Route::resource('object',          'ObjectController',         ['only' => [ 'index', 'show' ]]);
});
