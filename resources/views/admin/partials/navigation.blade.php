@include('partials.navigation')
<nav>
	<ul>
		<li>
			<span>Superadmin</span>
			<ul>
				<li>
					<a href="{{ route('superadmin.object.types') }}">Object types</a>
				</li>
			</ul>
		</li>
		@foreach ($types as $type)
			<li>
				<a href="{{ route('admin.objects', ['type' => $type]) }}">{{ str_plural($type->name) }}</a>
			</li>
		@endforeach
	</ul>
</nav>