@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $taxonomy->name }} terms</h1>
	
	<hr>
	@include('admin.builder.object.term.form-create')
	<hr>

	@if (count($parents))
		<ul id="object-terms-list">
			@foreach ($parents as $parent)
				@include('admin.builder.object.term.list-item-parent')
			@endforeach
		</ul>
	@endif
@endsection
