@include('partials.navigation')
<nav>
	<ul>
		<li>
			<span>Builder</span>
			<ul>
				<li>
					<a href="{{ route('object_type.index') }}">Object types</a>
					<ul>
						<li><a href="{{ route('object_type.create') }}">Create</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</nav>