<li>
	@include('admin.item.term.field-item', ['_term' => $parent])

	@if ($parent->hasChildren)
		<ul>
			@foreach ($parent->children as $child)
				@include('admin.item.term.field-item-parent', ['parent' => $child])
			@endforeach
		</ul>
	@endif
</li>