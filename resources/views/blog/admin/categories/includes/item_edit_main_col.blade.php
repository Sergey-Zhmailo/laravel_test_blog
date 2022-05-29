<div class="card bg-light">
    <div class="card-body">
        <div class="row justify-content-center">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" minlength="3" required>

            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug" class="form-control" value="{{ $item->slug }}">

            <label for="parent_id" class="form-label">Parent id</label>
            <select class="form-select" aria-label="Default select example" name="parent_id" required>
                @foreach($category_list as $categoryOption)
                    @php
                    /** @var \App\Models\BlogCategory $item */
                    @endphp
                    <option value="{{ $categoryOption->id }}"
                            @if($categoryOption->id === $item->parent_id) selected @endif
                    >{{ $categoryOption->id_title }}</option>
                @endforeach
            </select>

            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">
                {{ old('description', $item->description) }}</textarea>
        </div>
    </div>
</div>
