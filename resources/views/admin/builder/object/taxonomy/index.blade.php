@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $object_type->name }} taxonomies</h1>
	
	<hr>
	@include('admin.builder.object_taxonomy.form-create')
	<hr>

	@if (count($object_taxonomies))
		<ul id="object-types-list">
			@foreach ($object_taxonomies as $object_taxonomy)
				<li id="object-types-list-item-{{ $object_taxonomy->id }}" class="object-types-list-item">
					{{ $object_taxonomy->name }}

 					<button class="modal-trigger" data-modal="#show-object-type-{{ $object_taxonomy->id }}">Quick-view</button>
					<div id="show-object-type-{{ $object_taxonomy->id }}" class="modal">
						<a href="{{ route('object.taxonomy.show', [$object_type->slug, $object_taxonomy->slug]) }}">Open</a>
						<a href="{{ route('object.taxonomy.show', [$object_type->slug, $object_taxonomy->slug]) }}" target="_blank">Open in new tab</a>
						@include('object_taxonomy.content-main', ['object_taxonomy' => $object_taxonomy])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $object_taxonomy->id }}">Edit</button>
					<div id="edit-object-type-{{ $object_taxonomy->id }}" class="modal">
						@include('admin.builder.object_taxonomy.form-edit', [$object_type->slug, $object_taxonomy->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $object_taxonomy->id }}">Delete</button>
					<div id="delete-object-type-{{ $object_taxonomy->id }}" class="modal">
						@include('admin.builder.object_taxonomy.form-delete', [$object_type->slug, $object_taxonomy->slug])
					</div>

					<a href="{{-- {{ route('object_taxonomies.index', $object_taxonomy->slug) }} --}}">Terms</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
