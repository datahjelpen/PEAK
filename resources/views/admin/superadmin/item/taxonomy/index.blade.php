@extends('admin.partials.master')

@section('content-main')
	<h1>{{ $item_type->name }} taxonomies</h1>
	
	<hr>
	@include('admin.superadmin.item.taxonomy.form-create')
	<hr>

	@if (count($item_type->taxonomies))
		<ul id="item-item_types-list">
			@foreach ($item_type->taxonomies as $taxonomy)
				<li id="item-item_types-list-item-{{ $taxonomy->id }}" class="item-item_types-list-item">
					{{ $taxonomy->name }}

 					<button class="modal-trigger" data-modal="#show-item-item_type-{{ $taxonomy->id }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-item-item_type-{{ $taxonomy->id }}" class="modal">
						<button class="modal-close"><i data-feather="x-square"></i></button>
						<a href="{{ route('taxonomy.show', [$item_type->slug, $taxonomy->slug]) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('taxonomy.show', [$item_type->slug, $taxonomy->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
						@include('item.taxonomy.content-main', ['taxonomy' => $taxonomy])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-item-item_type-{{ $taxonomy->id }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-item-item_type-{{ $taxonomy->id }}" class="modal">
						<button class="modal-close"><i data-feather="x-square"></i></button>
						@include('admin.superadmin.item.taxonomy.form-edit', [$item_type->slug, $taxonomy->slug])
					</div>

					<button class="modal-trigger" data-modal="#delete-item-item_type-{{ $taxonomy->id }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-item-item_type-{{ $taxonomy->id }}" class="modal">
						<button class="modal-close"><i data-feather="x-square"></i></button>
						@include('admin.superadmin.item.taxonomy.form-delete', [$item_type->slug, $taxonomy->slug])
					</div>

					<a href="{{ route('admin.terms', [$item_type->slug, $taxonomy->slug]) }}">Terms</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
