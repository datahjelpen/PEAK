<label for="object-taxonomy-name">{{ __('general.name') }}</label>
<input type="text" id="object-taxonomy-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($taxonomy->name) ? $taxonomy->name : null) }}" autofocus>

<label for="object-taxonomy-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-taxonomy-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($taxonomy->slug) ? $taxonomy->slug : null) }}">

<label for="object-taxonomy-hierarchical">{{ __('general.hierarchical') }}</label>
<input type="checkbox" id="object-taxonomy-hierarchical" name="hierarchical" placeholder="hierarchical" {{ old('hierarchical', isset($taxonomy->hierarchical) ? $taxonomy->hierarchical : null) ? 'checked' : null }}>