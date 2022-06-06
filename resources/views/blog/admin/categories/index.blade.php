@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}">Add</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Parent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><a href="{{ route('blog.admin.categories.edit', $item->id) }}">{{ $item->title }}</a></td>
                                <td class="border border-slate-300 px-2 py-2"
                                    @if(in_array($item->parent_id, [1, 0])) style="color:green;" @endif>
{{--                                    {{ $item->parentCategory->title ?? '?' }}--}}
{{--                                    {{ optional($item->parentCategory)->title }}--}}
{{--                                        {{ $item->parent_title }} --}}{{-- accesser --}}
                                        {{ $item->parentTitle }}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="flex flex-row justify-center">
            @if($items->total() > $items->count())
                {{ $items->links() }}
            @endif
        </div>
    </div>
@endsection