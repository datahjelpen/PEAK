<h1>This is an taxonomy</h1>
<ul>
	<li>id:       {{ $taxonomy->id }}</li>
	<li>slug:     {{ $taxonomy->slug }}</li>
	<li>hierarchical: {{ $taxonomy->hierarchical }}</li>

	{{ dump($taxonomy->terms) }}
</ul>