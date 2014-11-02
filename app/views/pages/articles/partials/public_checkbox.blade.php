<div class="checkbox">
    <label>
        <input type="checkbox" name="public" value="1" {{ ($article->public) ? 'checked' : ''}}>
        This is a Public article (non-users can read it)
    </label>
</div>