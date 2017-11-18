<?php

use \App\Model\Object\Type;
use \App\Model\Object\Term;
use \App\Model\Object\Object;
use \App\Model\Object\Taxonomy;

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
			Route::prefix('taxonomy')->group(function () {
				Route::get('{taxonomy}/edit',      'Admin\Object\TaxonomyController@edit')->name('superadmin.object.taxonomy.edit');
				Route::patch('{taxonomy}/update',  'Admin\Object\TaxonomyController@update')->name('superadmin.object.taxonomy.update');
				Route::delete('{taxonomy}/delete', 'Admin\Object\TaxonomyController@destroy')->name('superadmin.object.taxonomy.destroy');
			});

			Route::get('statuses',           'Admin\Object\StatusController@index')->name('superadmin.statuses');
			Route::get('status/new',         'Admin\Object\StatusController@create')->name('superadmin.status.create');
			Route::post('status/create',     'Admin\Object\StatusController@store')->name('superadmin.status.store');
			Route::prefix('status')->group(function () {
				Route::get('{status}/edit',      'Admin\Object\StatusController@edit')->name('superadmin.status.edit');
				Route::patch('{status}/update',  'Admin\Object\StatusController@update')->name('superadmin.status.update');
				Route::delete('{status}/delete', 'Admin\Object\StatusController@destroy')->name('superadmin.status.destroy');
			});
		});
	});

	Route::prefix('{type}')->group(function () {
		Route::get('/',                  'Admin\Object\ObjectController@index')->name('admin.objects');
		Route::get('new',                'Admin\Object\ObjectController@create')->name('admin.object.create');
		Route::post('create',            'Admin\Object\ObjectController@store')->name('admin.object.store');
		Route::get('{object}/edit',      'Admin\Object\ObjectController@edit')->name('admin.object.edit');
		Route::patch('{object}/update',  'Admin\Object\ObjectController@update')->name('admin.object.update');
		Route::delete('{object}/delete', 'Admin\Object\ObjectController@destroy')->name('admin.object.destroy');

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
		Route::get('/', 'Object\TaxonomyController@show')->name('object.taxonomy.show');
		
		Route::prefix('{term}')->group(function () {
			Route::get('/', 'Object\TermController@show')->name('object.term.show');
			Route::get('{object}', 'Object\ObjectController@show')->name('object.show');
		});
	});
});