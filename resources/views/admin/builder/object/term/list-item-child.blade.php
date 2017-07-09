<li id="object-types-list-item-{{ $term->id }}" class="object-types-list-item">
	{{ $term->name }}

	@include('admin.builder.object.term.list-item', ['term' => $term])

	@if (isset($term->children))
		<button class="modal-trigger" data-modal="#show_children-object-type-{{ $term->id }}">{{ __('general.actions.show_children') }}</button>
		<div id="show_children-object-type-{{ $term->id }}" class="modal">
			<ul>
				@foreach ($term->children as $child)
					@include('admin.builder.object.term.list-item-child', ['term' => $child])
				@endforeach
			</ul>
		</div>
	@endif
</li>