@extends('app')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <form method="post" action="{{ route('blog.admin.categories.update', $item->id) }}">
                @method('PATCH')
                @csrf
                <div class="row">
                    @if($errors->any())
                        <div class="col col-md-12">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div>
                                    {{ $errors->first() }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if(session('success'))
                            <div class="col col-md-12">
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <div>
                                        {{ session()->get('success') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    <div class="col col-md-8">
                        @include('blog.admin.categories.includes.item_edit_main_col')
                    </div>
                    <div class="col col-md-4">
                        @include('blog.admin.categories.includes.item_edit_add_col')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection