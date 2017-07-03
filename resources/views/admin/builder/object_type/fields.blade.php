<label for="">name</label>
<input type="text" name="name" placeholder="name" value="{{ isset($object_type->name) ? $object_type->name : old('name') }}">

<label for="">slug</label>
<input type="text" name="slug" placeholder="slug" value="{{ isset($object_type->slug) ? $object_type->slug : old('slug') }}">

<label for="">template</label>
<input type="text" name="template" placeholder="template" value="{{ isset($object_type->template) ? $object_type->template : old('template') }}">