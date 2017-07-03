@include('partials.head')
<body>
    @include('partials.flash-messages')

	@include('admin.partials.navigation')
	
	@include('partials.main')
	
	@include('partials.sidebar')

	@include('partials.footer')
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/admin-global.js"></script>
</body>
</html>