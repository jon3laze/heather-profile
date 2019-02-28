@extends('layouts.app')

@section('content')
<div class="flex justify-center pb-2 py-2">
    <div class="w-1/3 sm:w-3/4">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="block text-blue text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email"
                    type="email"
                    class="form-control form-input"
                    name="email"
                    value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-6 flex justify-center">
                <button type="submit" class="button">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
        @if (session('status'))
            <div class="alert-success" role="alert">
              {{ session('status') }}
            </div>
        @endif
        @include('layouts.error')
    </div>
</div>
@endsection
