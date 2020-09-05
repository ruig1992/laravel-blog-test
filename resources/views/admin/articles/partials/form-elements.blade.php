<div class="form-group required">
    <label for="category" class="admin-control-label">Category</label>
    <select class="form-control @if($errors->has('category_id'))is-invalid @endif"
            id="category"
            name="category_id"
    >
        <option value="" disabled {{ (isset($article) || old('category_id') ? '' : 'selected') }}>__Select the category__</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ ( (old('category_id') ?: $article->category_id ?? null) == $category->id ? 'selected' : '') }}
            >{{ $category->name }}</option>
        @endforeach
    </select>
    <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
</div>
<div class="form-group required">
    <label for="title" class="admin-control-label">Title</label>
    <input type="text"
           class="form-control @if($errors->has('title'))is-invalid @endif"
           id="title"
           name="title"
           value="{{ old('title') ?: $article->title ?? null }}"
           maxlength="255"
    >
    <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
</div>
<div class="form-group required">
    <label for="description" class="admin-control-label">Description</label>
    <input type="text"
           class="form-control @if($errors->has('description'))is-invalid @endif"
           id="description"
           name="description"
           value="{{ old('description') ?: $article->description ?? null }}"
           maxlength="255"
    >
    <span role="alert" class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
</div>

<content-editor
    id="content"
    name="content"
    label="Content"
    :required="true"
    :is-invalid="{{ $errors->has('content') ? 'true' : 'false' }}"
    error-msg="{{ $errors->first('content') }}"
    value="{{ old('content') ?: $article->content ?? null }}"
>
    <template v-slot:extra="slotProps">
        @if(isset($article))
            <div class="mx-3 mt-4 mb-3">
                <random-image-search @insert-image="slotProps.insertImage"></random-image-search>
            </div>
        @endif
    </template>
</content-editor>

<div class="form-group">
    <label for="published_at" class="admin-control-label">Published datetime</label>
    <input type="text"
           class="form-control"
           id="published_at"
           name="published_at"
           value="{{ old('published_at') ?: $article->published_at ?? null }}"
           placeholder="0000-00-00 00:00"
    >
    <small class="form-text text-muted">Setting automatically as current if it's empty</small>
</div>
<div class="form-check mb-4">
    <input type="checkbox"
           value="1"
           class="form-check-input"
           id="is_published"
           name="is_published"
        {{ (!isset($article) || $article->is_published ? 'checked' : '') }}
    >
    <label class="form-check-label admin-control-label" for="is_published">Is published?</label>
</div>
