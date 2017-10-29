<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Titel' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title" type="text" id="title" value="{{ $foodlist->title or ''}}">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    <label for="body" class="col-md-4 control-label">{{ 'Body' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="body" type="textarea"
                  id="body">{{ $foodlist->body or ''}}</textarea>
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('categories') ? 'has-error' : ''}}">
    <label for="category" for="category_id" class="col-md-4 control-label">{{ 'Category' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="category_id" id="category_id">
            @foreach($categories as $category)
                    <option @if($foodlist->category_id == $category->id) selected="selected" @endif value="{{ $category->id }}">{{ $category->description }}</option>
            @endforeach
        </select>
    </div>
</div>

<input type="hidden" value="{{ Auth::user()->id }}" id="user_id" name="user_id"/>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
