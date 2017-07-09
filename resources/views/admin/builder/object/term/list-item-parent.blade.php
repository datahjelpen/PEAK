<li id="object-types-list-item-{{ $parent->id }}" class="object-types-list-item">
	{{ $parent->name }}

	@include('admin.builder.object.term.list-item', ['term' => $parent])

	@if (isset($parent->children))
		<ul>
			@foreach ($parent->children as $child)
				@include('admin.builder.object.term.list-item-child', ['term' => $child])
			@endforeach
		</ul>
	@endif
</li>