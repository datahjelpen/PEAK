<li id="object-types-list-item-{{ $parent->id }}" class="object-types-list-item">
	{{ $parent->name }}

	@include('admin.object.term.list-item', ['term' => $parent])

	@if ($taxonomy->hierarchical && $parent->hasChildren)
		<ul>
			@foreach ($parent->children as $child)
				@include('admin.object.term.list-item-child', ['term' => $child])
			@endforeach
		</ul>
	@endif
</li>