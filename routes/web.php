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

		Route::get('types',            'Admin\Object\TypeController@index')->name('object.types.index');
		Route::get('type/new',         'Admin\Object\TypeController@create')->name('object.type.create');
		Route::post('type/create',     'Admin\Object\TypeController@store')->name('object.type.store');
		Route::get('{type}/edit',      'Admin\Object\TypeController@edit')->name('object.type.edit');
		Route::patch('{type}/update',  'Admin\Object\TypeController@update')->name('object.type.update');
		Route::delete('{type}/delete', 'Admin\Object\TypeController@destroy')->name('object.type.destroy');

		Route::prefix('{type}')->group(function () {
			Route::get('taxonomies',           'Admin\Object\TaxonomyController@index')->name('object.taxonomies.index');
			Route::get('taxonomy/new',         'Admin\Object\TaxonomyController@create')->name('object.taxonomy.create');
			Route::post('taxonomy/create',     'Admin\Object\TaxonomyController@store')->name('object.taxonomy.store');
			Route::get('{taxonomy}/edit',      'Admin\Object\TaxonomyController@edit')->name('object.taxonomy.edit');
			Route::patch('{taxonomy}/update',  'Admin\Object\TaxonomyController@update')->name('object.taxonomy.update');
			Route::delete('{taxonomy}/delete', 'Admin\Object\TaxonomyController@destroy')->name('object.taxonomy.destroy');
			
			Route::prefix('{taxonomy}')->group(function () {
				Route::get('terms',            'Admin\Object\TermController@index')->name('object.terms.index');
				Route::get('term/new',         'Admin\Object\TermController@create')->name('object.term.create');
				Route::post('term/create',     'Admin\Object\TermController@store')->name('object.term.store');
				Route::get('{term}/edit',      'Admin\Object\TermController@edit')->name('object.term.edit');
				Route::patch('{term}/update',  'Admin\Object\TermController@update')->name('object.term.update');
				Route::delete('{term}/delete', 'Admin\Object\TermController@destroy')->name('object.term.destroy');
			});
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
	Route::prefix('{taxonomy}')->group(function () {
		Route::get('/',      'Object\TaxonomyController@show')->name('object.taxonomy.show');
		Route::get('{term}', 'Object\TermController@show')->name('object.term.show');
	});
	// Route::resource('object_category', 'ObjectCategoryController', ['only' => [ 'index', 'show' ]]);
	// Route::resource('object_tag',      'ObjectTagController',      ['only' => [ 'index', 'show' ]]);
	// Route::resource('object',          'ObjectController',         ['only' => [ 'index', 'show' ]]);
});
