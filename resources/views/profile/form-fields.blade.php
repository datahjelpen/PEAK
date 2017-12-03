<label for="item-profile-image">{{ ucfirst(__('general.image')) }}</label>
<input type="file" id="item-profile-image" class="autofocus" name="image" value="{{ old('image') }}">

<label for="item-profile-image_remove">{{ ucfirst(__('general.image_remove')) }}</label>
<input type="checkbox" id="item-profile-image_remove" name="image_remove" {{ old('image_remove') ? 'checked' : null }}>

<label for="item-profile-url">{{ ucfirst(__('general.url')) }}</label>
<input type="text" id="item-profile-url" name="url" placeholder="url" value="{{ old('url', isset($profile->url) ? $profile->url : null) }}" required>

<label for="item-profile-name_first">{{ ucfirst(__('general.name_first')) }}</label>
<input type="text" id="item-profile-name_first" name="name_first" placeholder="name_first" value="{{ old('name_first', isset($profile->name_first) ? $profile->name_first : null) }}" autofocus>

<label for="item-profile-name_last">{{ ucfirst(__('general.name_last')) }}</label>
<input type="text" id="item-profile-name_last" name="name_last" placeholder="name_last" value="{{ old('name_last', isset($profile->name_last) ? $profile->name_last : null) }}">

<label for="item-profile-name_display">{{ ucfirst(__('general.name_display')) }}</label>
<input type="text" id="item-profile-name_display" name="name_display" placeholder="name_display" value="{{ old('name_display', isset($profile->name_display) ? $profile->name_display : null) }}">

<label for="item-profile-title">{{ ucfirst(__('general.title')) }}</label>
<input type="text" id="item-profile-title" name="title" placeholder="title" value="{{ old('title', isset($profile->title) ? $profile->title : null) }}">

<label for="item-profile-email_display">{{ ucfirst(__('general.email_display')) }}</label>
<input type="text" id="item-profile-email_display" name="email_display" placeholder="email_display" value="{{ old('email_display', isset($profile->email_display) ? $profile->email_display : null) }}">