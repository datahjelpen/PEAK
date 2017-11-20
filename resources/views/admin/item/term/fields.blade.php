<label for="item-term-name">{{ __('general.name') }}</label>
<input type="text" id="item-term-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($term->name) ? $term->name : null) }}" autofocus>

<label for="item-term-slug">{{ __('general.slug') }}</label>
<input type="text" id="item-term-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($term->slug) ? $term->slug : null) }}">

@if ($taxonomy->hierarchical)
	<p>{{ __('general.parent') }}</p>
	<ul>
		@foreach ($parents as $parent)
			@include('admin.item.term.field-item-parent')
		@endforeach
	</ul>
@endif

<label for="item-term-template">{{ __('general.template') }}</label>
<input type="text" id="item-term-template" name="template" placeholder="template" value="{{ old('template', isset($term->template) ? $term->template : null) }}">