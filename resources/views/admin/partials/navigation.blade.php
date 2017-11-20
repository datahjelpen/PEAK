@include('partials.navigation')
<nav>
	<ul>
		<li>
			<span>Superadmin</span>
			<ul>
				<li>
					<a href="{{ route('superadmin.item_types') }}">Types</a>
				</li>
			</ul>
		</li>
		@foreach ($item_types as $item_type)
			<li>
				<a href="{{ route('admin.items', ['item_type' => $item_type]) }}">{{ str_plural($item_type->name) }}</a>
			</li>
		@endforeach
	</ul>
</nav>