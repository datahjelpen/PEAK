<li id="item-item_types-list-item-{{ $term->id }}" class="item-item_types-list-item">
	{{ $term->name }}

	@include('admin.item.term.list-item', ['term' => $term])

	@if ($term->hasChildren)
		<button class="modal-trigger" data-modal="#show_children-item-item_type-{{ $term->id }}">{{ __('general.actions.show_children') }}</button>
		<div id="show_children-item-item_type-{{ $term->id }}" class="modal">
			<ul>
				@foreach ($term->children as $child)
					@include('admin.item.term.list-item-child', ['term' => $child])
				@endforeach
			</ul>
		</div>
	@endif
</li>