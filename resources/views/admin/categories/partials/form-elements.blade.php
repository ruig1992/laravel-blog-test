<div class="form-group required">
    <label for="name" class="admin-control-label">Name</label>
    <input type="text"
           class="form-control @if($errors->has('name'))is-invalid @endif"
           id="name"
           name="name"
           value="{{ old('name', $category->name ?? null) }}"
           maxlength="255"
    >
    <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
</div>
