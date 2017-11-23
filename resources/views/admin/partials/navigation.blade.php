@include('partials.navigation')
<nav id="nav-superadmin">
	<ul>
		<li><strong>Superadmin</strong></li>
		<li>
			<a href="{{ route('superadmin.item_types') }}">Types</a>
		</li>
	</ul>
</nav>
<nav id="nav-admin">
	<ul>
		<li><strong>Edit</strong></li>
		@foreach ($item_types as $item_type)
			<li>
				<a href="{{ route('admin.items', ['item_type' => $item_type]) }}">{{ str_plural($item_type->name) }}</a>
			</li>
		@endforeach
	</ul>
</nav>