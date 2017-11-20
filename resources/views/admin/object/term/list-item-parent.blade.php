<li id="item-item_types-list-item-{{ $parent->id }}" class="item-item_types-list-item">
	{{ $parent->name }}

	@include('admin.item.term.list-item', ['term' => $parent])

	@if ($taxonomy->hierarchical && $parent->hasChildren)
		<ul>
			@foreach ($parent->children as $child)
				@include('admin.item.term.list-item-child', ['term' => $child])
			@endforeach
		</ul>
	@endif
</li>