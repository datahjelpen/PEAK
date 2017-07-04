@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $type->name }} taxonomies</h1>
	
	<hr>
	@include('admin.builder.object.taxonomy.form-create')
	<hr>

	@if (count($taxonomies))
		<ul id="object-types-list">
			@foreach ($taxonomies as $taxonomy)
				<li id="object-types-list-item-{{ $taxonomy->id }}" class="object-types-list-item">
					{{ $taxonomy->name }}

 					<button class="modal-trigger" data-modal="#show-object-type-{{ $taxonomy->id }}">Quick-view</button>
					<div id="show-object-type-{{ $taxonomy->id }}" class="modal">
						<a href="{{ route('object.taxonomy.show', [$type->slug, $taxonomy->slug]) }}">Open</a>
						<a href="{{ route('object.taxonomy.show', [$type->slug, $taxonomy->slug]) }}" target="_blank">Open in new tab</a>
						@include('object.taxonomy.content-main', ['taxonomy' => $taxonomy])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $taxonomy->id }}">Edit</button>
					<div id="edit-object-type-{{ $taxonomy->id }}" class="modal">
						@include('admin.builder.object.taxonomy.form-edit', [$type->slug, $taxonomy->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $taxonomy->id }}">Delete</button>
					<div id="delete-object-type-{{ $taxonomy->id }}" class="modal">
						@include('admin.builder.object.taxonomy.form-delete', [$type->slug, $taxonomy->slug])
					</div>

					<a href="{{-- {{ route('object_taxonomies.index', $taxonomy->slug) }} --}}">Terms</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
