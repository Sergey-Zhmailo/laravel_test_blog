@extends('app')
@section('content')
    @php
        /** @var \App\Models\BlogPost $item */
    @endphp

    <div class="container mx-auto">
        <div class="row">
            @if ($item->exists)
                <form method="post" action="{{ route('blog.admin.posts.update', $item->id) }}">
                    @method('PATCH')
            @else
                <form method="post" action="{{ route('blog.admin.posts.store') }}">
            @endif
                    @csrf
                    <div class="row">
                        @include('blog.admin.posts.includes.item_edit_messages')

                        <div class="col col-md-8">
                            @include('blog.admin.posts.includes.item_edit_main_col')
                        </div>
                        <div class="col col-md-4">
                            @include('blog.admin.posts.includes.item_edit_add_col')
                        </div>
                    </div>
                </form>

            @if ($item->exists)
                <form method="post" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
                    @method('DELETE')
                    @csrf
                    <div class="col col-md-8">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <input type="submit" value="Delete" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-4">

                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection