 <div class="input-group push-bottom">
    <select name="category_id" class="form-control">
        <option value="0" {{ ($article->category_id == 0) ? 'selected' : '' }}>- Select a Category -</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}" {{ ($article->category_id == $category->id) ? 'selected' : '' }}>{{ $category->label }}</option>
        @endforeach
    </select>
</div>