@if($errors->any())
    <div class="col col-md-12">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
{{--                {{ $errors->first() }}--}}
                <ul>
                    @foreach($errors->all() as $errorText)
                        <li>{{ $errorText }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@php
    /** @var \Illuminate\Support\ViewErrorBag $errors */
@endphp
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