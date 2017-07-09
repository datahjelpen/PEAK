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

	Route::prefix('superadmin')->group(function () {
		Route::get('types',            'Admin\Object\TypeController@index')->name('superadmin.object.types');
		Route::get('type/new',         'Admin\Object\TypeController@create')->name('superadmin.object.type.create');
		Route::post('type/create',     'Admin\Object\TypeController@store')->name('superadmin.object.type.store');
		Route::get('{type}/edit',      'Admin\Object\TypeController@edit')->name('superadmin.object.type.edit');
		Route::patch('{type}/update',  'Admin\Object\TypeController@update')->name('superadmin.object.type.update');
		Route::delete('{type}/delete', 'Admin\Object\TypeController@destroy')->name('superadmin.object.type.destroy');

		Route::prefix('{type}')->group(function () {
			Route::get('taxonomies',           'Admin\Object\TaxonomyController@index')->name('superadmin.object.taxonomies');
			Route::get('taxonomy/new',         'Admin\Object\TaxonomyController@create')->name('superadmin.object.taxonomy.create');
			Route::post('taxonomy/create',     'Admin\Object\TaxonomyController@store')->name('superadmin.object.taxonomy.store');
			Route::get('{taxonomy}/edit',      'Admin\Object\TaxonomyController@edit')->name('superadmin.object.taxonomy.edit');
			Route::patch('{taxonomy}/update',  'Admin\Object\TaxonomyController@update')->name('superadmin.object.taxonomy.update');
			Route::delete('{taxonomy}/delete', 'Admin\Object\TaxonomyController@destroy')->name('superadmin.object.taxonomy.destroy');
		});
	});

	Route::prefix('{type}')->group(function () {
		Route::get('/', 'Admin\Object\TypeController@index')->name('admin.object.types');

		Route::prefix('{taxonomy}')->group(function () {
			Route::get('/',                'Admin\Object\TermController@index')->name('admin.object.terms');
			Route::get('term/new',         'Admin\Object\TermController@create')->name('admin.object.term.create');
			Route::post('term/create',     'Admin\Object\TermController@store')->name('admin.object.term.store');
			Route::get('{term}/edit',      'Admin\Object\TermController@edit')->name('admin.object.term.edit');
			Route::patch('{term}/update',  'Admin\Object\TermController@update')->name('admin.object.term.update');
			Route::delete('{term}/delete', 'Admin\Object\TermController@destroy')->name('admin.object.term.destroy');
		});
	});

	Route::get('oauth-dashboard', 'Admin\DashboardController@oauth')->name('oauth-dashboard');
});

Route::get('/', function () {
	return view('welcome', compact('types'));
})->name('frontpage');

Route::prefix('{type}')->group(function () {
	Route::get('/', 'Object\TypeController@show')->name('object.type.show');
	Route::prefix('{taxonomy}')->group(function () {
		Route::get('/',      'Object\TaxonomyController@show')->name('object.taxonomy.show');
		Route::get('{term}', 'Object\TermController@show')->name('object.term.show');
	});

	// Route::resource('object_category', 'ObjectCategoryController', ['only' => [ 'index', 'show' ]]);
	// Route::resource('object_tag',      'ObjectTagController',      ['only' => [ 'index', 'show' ]]);
	// Route::resource('object',          'ObjectController',         ['only' => [ 'index', 'show' ]]);
});
