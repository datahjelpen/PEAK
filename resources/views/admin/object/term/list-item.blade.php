<button class="modal-trigger" data-modal="#show-item-item_type-{{ $term->id }}">{{ __('navigation.actions.view_quick') }}</button>
<div id="show-item-item_type-{{ $term->id }}" class="modal">
	<a href="{{ route('term.show', [$item_type->slug, $taxonomy->slug, $term->slug]) }}">{{ __('general.actions.open') }}</a>
	<a href="{{ route('term.show', [$item_type->slug, $taxonomy->slug, $term->slug]) }}" target="_blank">{{ __('navigation.actions.open_new_tab') }}</a>
	@include('item.term.content-main', ['term' => $term])
</div>

<button class="modal-trigger" data-modal="#edit-item-item_type-{{ $term->id }}">{{ __('general.actions.edit') }}</button>
<div id="edit-item-item_type-{{ $term->id }}" class="modal">
	@include('admin.item.term.form-edit', [$item_type->slug, $taxonomy->slug, $term->slug])
</div>

<button class="modal-trigger" data-modal="#delete-item-item_type-{{ $term->id }}">{{ __('general.actions.delete') }}</button>
<div id="delete-item-item_type-{{ $term->id }}" class="modal">
	@include('admin.item.term.form-delete', [$item_type->slug, $taxonomy->slug, $term->slug])
</div>