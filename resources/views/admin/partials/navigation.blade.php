<nav>
	<ul>
		<li>
			<a href="{{ route('frontpage') }}">
				<img src="/images/peak/logo/black-512-comp.png" data-highres="/images/peak/logo/black-512.png" alt="{{ config('app.name', 'PEAK') }} logo">
				<span>{{ config('app.name', 'PEAK') }}</span>
			</a>
		</li>
		<li><a href="{{ route('admin.dashboard') }}">admin</a></li>
		<li>
			<span>{{ Auth::user()->name }}</span>
			<ul>
				<li>
					<a id="admin-logout-action" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
						Logout
					</a>
					<form id="admin-logout-form" action="{{ route('logout') }}" method="POST">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
		</li>
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