

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $term->name) }}" required autofocus>

        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
    <div class="col-md-6">
        <textarea id="content" name="content" class="form-control" rows="8">{{ old('content', $term->content) }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="publication-date" class="col-md-4 col-form-label text-md-right">{{ __('Publication Date') }}</label>

    <div class="col-md-6">
        <input id="publication-date" type="text" class="form-control" name="published_at" value="{{ old('published_at', isset($term->published_at) ? $term->published_at : 'Unpublished') }}" autofocus disabled="true">
    </div>
</div>
<div class="form-check row">
    <label for="publish" class="col-md-4 col-form-label text-md-right">{{ __('Publish?') }}</label>
    <input type="hidden" name="publish" value="0">
    <input id="publish" type="checkbox" class="" name="publish" value="1" {{ isset($term->published_at) ? 'checked disabled' : '' }}>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Update') }}
        </button>
    </div>
</div>
