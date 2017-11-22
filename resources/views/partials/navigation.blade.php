<nav>
	<ul>
		<li>
			<a href="{{ route('frontpage') }}">
				<img class="comp" src="/images/peak/logo/black-512-comp.png" data-highres="/images/peak/logo/black-512.png" alt="{{ config('app.name', 'PEAK') }} logo">
				<span>{{ config('app.name', 'PEAK') }}</span>
			</a>
		</li>
		<li><a href="{{ route('admin.dashboard') }}">admin</a></li>
		<li>
			<a href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
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
	</ul>
</nav>