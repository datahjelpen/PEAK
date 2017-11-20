<?php

use \App\Model\Item\Item_type;
use \App\Model\Item\Term;
use \App\Model\Item\Item;
use \App\Model\Item\Taxonomy;

Auth::routes();

Route::prefix('admin')->group(function () {

	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

	Route::prefix('superadmin')->group(function () {

		Route::get('item_types',        'Admin\Item\Item_typeController@index')->name('superadmin.item_types');
		Route::get('item_type/new',     'Admin\Item\Item_typeController@create')->name('superadmin.item_type.create');
		Route::post('item_type/create', 'Admin\Item\Item_typeController@store')->name('superadmin.item_type.store');
		Route::prefix('item_type')->group(function () {
			Route::get('{item_type}/edit',      'Admin\Item\Item_typeController@edit')->name('superadmin.item_type.edit');
			Route::patch('{item_type}/update',  'Admin\Item\Item_typeController@update')->name('superadmin.item_type.update');
			Route::delete('{item_type}/delete', 'Admin\Item\Item_typeController@destroy')->name('superadmin.item_type.destroy');
		});

		Route::prefix('{item_type}')->group(function () {
			Route::get('taxonomies',       'Admin\Item\TaxonomyController@index')->name('superadmin.taxonomies');
			Route::get('taxonomy/new',     'Admin\Item\TaxonomyController@create')->name('superadmin.taxonomy.create');
			Route::post('taxonomy/create', 'Admin\Item\TaxonomyController@store')->name('superadmin.taxonomy.store');
			Route::prefix('taxonomy')->group(function () {
				Route::get('{taxonomy}/edit',      'Admin\Item\TaxonomyController@edit')->name('superadmin.taxonomy.edit');
				Route::patch('{taxonomy}/update',  'Admin\Item\TaxonomyController@update')->name('superadmin.taxonomy.update');
				Route::delete('{taxonomy}/delete', 'Admin\Item\TaxonomyController@destroy')->name('superadmin.taxonomy.destroy');
			});

			Route::get('statuses',       'Admin\Item\StatusController@index')->name('superadmin.statuses');
			Route::get('status/new',     'Admin\Item\StatusController@create')->name('superadmin.status.create');
			Route::post('status/create', 'Admin\Item\StatusController@store')->name('superadmin.status.store');
			Route::prefix('status')->group(function () {
				Route::get('{status}/edit',      'Admin\Item\StatusController@edit')->name('superadmin.status.edit');
				Route::patch('{status}/update',  'Admin\Item\StatusController@update')->name('superadmin.status.update');
				Route::delete('{status}/delete', 'Admin\Item\StatusController@destroy')->name('superadmin.status.destroy');
			});
		});

	});

	Route::prefix('{item_type}')->group(function () {
		Route::get('/',                'Admin\Item\ItemController@index')->name('admin.items');
		Route::get('new',              'Admin\Item\ItemController@create')->name('admin.item.create');
		Route::post('create',          'Admin\Item\ItemController@store')->name('admin.item.store');
		Route::get('{item}/edit',      'Admin\Item\ItemController@edit')->name('admin.item.edit');
		Route::patch('{item}/update',  'Admin\Item\ItemController@update')->name('admin.item.update');
		Route::delete('{item}/delete', 'Admin\Item\ItemController@destroy')->name('admin.item.destroy');

		Route::prefix('{taxonomy}')->group(function () {
			Route::get('/',                'Admin\Item\TermController@index')->name('admin.terms');
			Route::get('term/new',         'Admin\Item\TermController@create')->name('admin.term.create');
			Route::post('term/create',     'Admin\Item\TermController@store')->name('admin.term.store');
			Route::get('{term}/edit',      'Admin\Item\TermController@edit')->name('admin.term.edit');
			Route::patch('{term}/update',  'Admin\Item\TermController@update')->name('admin.term.update');
			Route::delete('{term}/delete', 'Admin\Item\TermController@destroy')->name('admin.term.destroy');
		});
	});

	Route::get('oauth-dashboard', 'Admin\DashboardController@oauth')->name('oauth-dashboard');
});

Route::get('/', function () {
	return view('welcome', compact('item_types'));
})->name('frontpage');

Route::prefix('{item_type}')->group(function () {

	Route::get('/', 'Item\Item_typeController@show')->name('item_type.show');

	Route::prefix('{taxonomy}')->group(function () {
		Route::get('/', 'Item\TaxonomyController@show')->name('taxonomy.show');
		
		Route::prefix('{term}')->group(function () {
			Route::get('/', 'Item\TermController@show')->name('term.show');
			Route::get('{item}', 'Item\ItemController@show')->name('item.show');
		});
	});
});