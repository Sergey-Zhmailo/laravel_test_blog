<div class="row justify-content-center">
    <label for="title" class="form-label">Title</label>
    <input type="text" id="title" class="form-control" value="{{ $item->title }}">

    <label for="slug" class="form-label">Slug</label>
    <input type="text" id="slug" class="form-control" value="{{ $item->slug }}">

    <label for="parent_id" class="form-label">Parent id</label>
    <select class="form-select" aria-label="Default select example" required>
        @foreach($category_list as $categoryOption)
            <option value="{{ $categoryOption->id }}"
                    @if($categoryOption->id == $item->parent_id) selected @endif
            >{{ $categoryOption->id }}. {{ $categoryOption->title }}</option>
        @endforeach

        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
</div>
