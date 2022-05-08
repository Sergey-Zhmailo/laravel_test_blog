@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-center">
            <table class="table-auto border-collapse border border-slate-400 shadow-md">
                <thead>
                <tr>
                    <th class="border border-slate-300">Song</th>
                    <th class="border border-slate-300">Artist</th>
                    <th class="border border-slate-300">Year</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <table>


    </table>
@endsection