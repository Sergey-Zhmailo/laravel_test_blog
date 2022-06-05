@php
/** @var \App\Models\BlogPost $item */
@endphp
<div class="card bg-light">
    <div class="card-header">
        @if ($item->is_published)
            Published
        @else
            Draft
        @endif
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <ul class="nav nav-tabs" id="edit_post_tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="main_tab" data-bs-toggle="tab" data-bs-target="#main" type="button" role="tab" aria-controls="main" aria-selected="true">Main</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="addition_tab" data-bs-toggle="tab" data-bs-target="#addition" type="button" role="tab" aria-controls="addition" aria-selected="false">Addition</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="home-tab">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $item->title) }}" minlength="3" required>

                    <label for="content_raw" class="form-label">Content</label>
                    <textarea name="content_raw" id="content_raw" class="form-control" rows="20">
                {{ old('content_raw', $item->content_raw) }}</textarea>
                </div>
                <div class="tab-pane fade" id="addition" role="tabpanel" aria-labelledby="profile-tab">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" aria-label="Default select example" name="category_id" required>
                        @foreach($category_list as $categoryOption)
                            @php
                                /** @var \App\Models\BlogCategory $item */
                            @endphp
                            <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id === $item->category_id) selected @endif
                            >{{ $categoryOption->id_title }}</option>
                        @endforeach
                    </select>
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $item->slug }}">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>

                    <input type="hidden" name="is_published" value="0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_published" id="is_published"
                        @if ($item->is_published)
                            checked="checked"
                        @endif
                        >
                        <label class="form-check-label" for="is_published">
                            Is published
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
