@extends('admin.partials.master')

@section('content-main')
	<h1>{{ str_plural($item_type->name) }}</h1>
	
	<hr>
	@include('admin.item.form-create')
	<hr>

	<ul id="item-terms-list">
		@foreach ($item_type->items as $item)
			<li id="item-item_types-list-item-{{ $item->id }}" class="item-item_types-list-item">
				{{ $item->name }}

				<button class="modal-trigger" data-modal="#show-item-item_type-{{ $item->id }}">{{ __('navigation.actions.view_quick') }}</button>
				<div id="show-item-item_type-{{ $item->id }}" class="modal">
					{{-- <a href="{{ route('item.show', [$item_type->slug, $item->slug]) }}">{{ __('general.actions.open') }}</a> --}}
					{{-- <a href="{{ route('item.show', [$item_type->slug, $item->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a> --}}
					<button class="modal-close"><i data-feather="x-square"></i></button>
					@include('item.content-main', ['item' => $item])
				</div>

				<button class="modal-trigger" data-modal="#edit-item-item_type-{{ $item->id }}">{{ __('general.actions.edit') }}</button>
				<div id="edit-item-item_type-{{ $item->id }}" class="modal">
					<button class="modal-close"><i data-feather="x-square"></i></button>
					@include('admin.item.form-edit', [$item_type->slug, $item->slug])
				</div>

				<button class="modal-trigger" data-modal="#delete-item-item_type-{{ $item->id }}">{{ __('general.actions.delete') }}</button>
				<div id="delete-item-item_type-{{ $item->id }}" class="modal">
					<button class="modal-close"><i data-feather="x-square"></i></button>
					@include('admin.item.form-delete', [$item_type->slug, $item->slug])
				</div>
			</li>
		@endforeach
	</ul>
@endsection
