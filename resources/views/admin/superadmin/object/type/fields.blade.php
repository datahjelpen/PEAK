<label for="object-type-name">{{ __('general.name') }}</label>
<input type="text" id="object-type-name" class="autofocus" name="name" placeholder="name" value="{{ old('name', isset($type->name) ? $type->name : null) }}" required autofocus>

<label for="object-type-slug">{{ __('general.slug') }}</label>
<input type="text" id="object-type-slug" name="slug" placeholder="slug" value="{{ old('slug', isset($type->slug) ? $type->slug : null) }}">

<label for="object-type-template">{{ __('general.template') }}</label>
<input type="number" id="object-type-template" name="template" placeholder="template" value="{{ old('template', isset($type->template) ? $type->template : null) }}" >