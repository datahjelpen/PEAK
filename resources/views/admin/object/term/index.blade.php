@extends('admin.partials.master')

@section('content-main')
	<h1>{{ str_plural($taxonomy->name) }}</h1>
	
	<hr>
	@include('admin.object.term.form-create')
	<hr>

	<ul id="object-terms-list">
		@foreach ($parents as $parent)
			@include('admin.object.term.list-item-parent')
		@endforeach
	</ul>
@endsection
