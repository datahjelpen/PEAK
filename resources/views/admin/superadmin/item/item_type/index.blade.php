@extends('admin.partials.master')

@section('content-main')
	<h1>item types</h1>
	
	<hr>
	@include('admin.superadmin.item.item_type.form-create')
	<hr>

	@if (count($item_types))
		<ul id="item-item_types-list">
			@foreach ($item_types as $item_type)
				<li id="item-item_types-list-item-{{ $item_type->slug }}" class="item-item_types-list-item">
					{{ $item_type->name }}

					<button class="modal-trigger" data-modal="#show-item-item_type-{{ $item_type->slug }}">{{ __('navigation.actions.view_quick') }}</button>
					<div id="show-item-item_type-{{ $item_type->slug }}" class="modal">
{{-- 						<a href="{{ route('item.item_type.show', $item_type->slug) }}">{{ __('general.actions.open') }}</a>
						<a href="{{ route('item.item_type.show', $item_type->slug) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a> --}}
						@include('item.item_type.content-main', ['item_type' => $item_type])
					</div>
					
					<button class="modal-trigger" data-modal="#edit-item-item_type-{{ $item_type->slug }}">{{ __('general.actions.edit') }}</button>
					<div id="edit-item-item_type-{{ $item_type->slug }}" class="modal">
						@include('admin.superadmin.item.item_type.form-edit', ['item_type' => $item_type])
					</div>

					<button class="modal-trigger" data-modal="#delete-item-item_type-{{ $item_type->slug }}">{{ __('general.actions.delete') }}</button>
					<div id="delete-item-item_type-{{ $item_type->slug }}" class="modal">
						@include('admin.superadmin.item.item_type.form-delete', ['item_type' => $item_type])
					</div>

					<a href="{{ route('superadmin.taxonomies', $item_type->slug) }}">Taxonomies</a>
					<a href="{{ route('superadmin.statuses', $item_type->slug) }}">Statuses</a>
				</li>
			@endforeach
		</ul>
	@endif
@endsection
