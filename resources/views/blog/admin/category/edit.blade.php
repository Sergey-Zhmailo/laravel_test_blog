@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-center">
            <form method="post" action="{{ route('blog.admin.categories.update', $item->id) }}">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col col-md-8">
                        @include('blog.admin.category.includes.item_edit_main_col')
                    </div>
                    <div class="col col-md-4">
                        {{--                    @include('blog.admin.category.includes.item_edit_add_col')--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table>


    </table>
@endsection