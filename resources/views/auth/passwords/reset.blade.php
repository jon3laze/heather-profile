@extends('layouts.app')

@section('content')
<div class="flex justify-center pb-2 py-2">
    <div class="w-1/3 sm:w-3/4">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="block text-blue text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email"
                    type="email"
                    class="form-control form-input"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    required
                    autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="block text-blue text-sm font-bold mb-2">{{ __('Password') }}</label>

                <input id="password"
                    type="password"
                    class="form-control form-input"
                    name="password"
                    required>
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="block text-blue text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control form-input" name="password_confirmation" required>
            </div>

            <div class="mb-3 flex justify-center">
                <button type="submit" class="btn btn-fancy">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
        @include('layouts.error')
    </div>
</div>
@endsection
