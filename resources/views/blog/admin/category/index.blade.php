@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-center">
            <a class="btn btn-primary"
               href="{{ route('blog.admin.categories.create') }}">Add</a>
        </div>
        <div class="flex flex-row justify-center">
            <table class="table-auto border-collapse border border-slate-400 shadow-md rounded-md bg-slate-200">
                <thead class="bg-slate-200">
                <tr>
                    <th class="border border-slate-300 px-2 py-2">ID</th>
                    <th class="border border-slate-300 px-2 py-2">Title</th>
                    <th class="border border-slate-300 px-2 py-2">Parent</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="border border-slate-300 px-2 py-2">{{$item->id}}</td>
                        <td class="border border-slate-300 px-2 py-2"><a
                                    href="{{ route('blog.admin.categories.edit', $item->id) }}">{{ $item->title }}</a>
                        </td>
                        <td class="border border-slate-300 px-2 py-2"
                            @if(in_array($item->parent_id, [1, 0])) style="color:green;" @endif>{{ $item->parent_id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex flex-row justify-center">
            @if($items->total() > $items->count())
                {{ $items->links() }}
            @endif
        </div>
    </div>
    <table>


    </table>
@endsection