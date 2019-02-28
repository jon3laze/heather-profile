@if($errors->any())
    <div class="flex flex-col mb-3">
        @foreach($errors->all() as $error)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
    </div>
@endif
