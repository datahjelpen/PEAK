@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $type->name }} taxonomies</h1>
	
	<hr>
	@include('admin.superadmin.object.taxonomy.form-create')
	<hr>

	@if (count($taxonomies))
		<ul id="object-types-list">
			@foreach ($taxonomies as $taxonomy)
				<li id="object-types-list-item-{{ $taxonomy->id }}" class="object-types-list-item">
					{{ $taxonomy->name }}

 					<button class="modal-trigger" data-modal="#show-object-type-{{ $taxonomy->id }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-object-type-{{ $taxonomy->id }}" class="modal">
						<a href="{{ route('taxonomy.show', [$type->slug, $taxonomy->slug]) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('taxonomy.show', [$type->slug, $taxonomy->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
						@include('object.taxonomy.content-main', ['taxonomy' => $taxonomy])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-object-type-{{ $taxonomy->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-object-type-{{ $taxonomy->id }}" class="modal">
						@include('admin.superadmin.object.taxonomy.form-edit', [$type->slug, $taxonomy->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-object-type-{{ $taxonomy->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-object-type-{{ $taxonomy->id }}" class="modal">
						@include('admin.superadmin.object.taxonomy.form-delete', [$type->slug, $taxonomy->slug])
					</div>

					<a href="{{ route('admin.terms', [$type->slug, $taxonomy->slug]) }}">Terms</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
