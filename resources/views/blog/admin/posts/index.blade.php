@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Add POst</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Publish date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $post)
                            @php
                            /**
                            * @var \App\Models\BlogPost $post
                            */
                            @endphp
                            <tr @if(!$post->is_published) style="background-color: #ccc;" @endif>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->category->title}}</td>
                                <td><a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="flex flex-row justify-center">
            @if($paginator->total() > $paginator->count())
                {{ $paginator->links() }}
            @endif
        </div>
    </div>
@endsection