<label for="object-term-name">{{ __('general.name') }}</label>
<input type="text" id="object-term-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($term->name) ? $term->name : null) }}" autofocus>

<label for="object-term-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-term-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($term->slug) ? $term->slug : null) }}">

@if ($taxonomy->hierarchical)
	<p>{{ __('general.parent') }}</p>
	<ul>
		@foreach ($parents as $parent)
			@include('admin.object.term.field-item-parent')
		@endforeach
	</ul>
@endif

<label for="object-term-template">{{ __('general.template') }}</label>
<input type="text" id="object-term-template" name="template" placeholder="template" value="{{ old('template', isset($term->template) ? $term->template : null) }}">