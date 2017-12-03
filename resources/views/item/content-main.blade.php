<h1>This is an item</h1>
{{ dump($item) }}

<pre>
	@foreach ($item->terms as $term)
		{{ $term->name }}
	@endforeach
</pre>


<ul>
	<li>id:        {{ $item->id }}</li>
	<li>name:      {{ $item->name }}</li>
	<li>slug:      {{ $item->slug }}</li>
	<li>template:  {{ $item->template }}</li>
	<li>text:      {{ $item->text }}</li>
	<li>excerpt:   {{ $item->excerpt }}</li>
	<li>item_type: {{ $item->item_type }}</li>
	<li>author:    {{ $item->author }}</li>
	<li>comments:  {{ $item->comments }}</li>
	<li>status:    {{ $item->status }}</li>
</ul>