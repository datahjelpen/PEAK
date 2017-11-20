@extends('admin.partials.master')

@section('content-main')
	<h1>{{ str_plural($taxonomy->name) }}</h1>
	
	<hr>
	@include('admin.item.term.form-create')
	<hr>

	<ul id="item-terms-list">
		@foreach ($parents as $parent)
			@include('admin.item.term.list-item-parent')
		@endforeach
	</ul>
@endsection
