<div class="card bg-light">
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
        @if($item->exists)
            <div class="card">
                <div class="card-body">
                    ID: {{ $item->id }}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Created: {{ $item->created_at }}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Edited: {{ $item->updated_at }}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Published: {{ $item->published_at }}
                </div>
            </div>
        @endif
    </div>
</div>
