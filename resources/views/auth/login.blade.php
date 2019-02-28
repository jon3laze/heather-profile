@extends('layouts.app')

@section('content')
<div class="flex justify-center pb-2 py-2">
    <div class="w-1/3 sm:w-3/4">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="block text-blue text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email"
                    type="email"
                    class="form-control form-input"
                    name="email"
                    value="{{ old('email') }}"
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

            <div class="mb-3 flex justify-end p-3">
                <input class="form-check-input mr-2"
                    type="checkbox"
                    name="remember"
                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="block text-grey text-sm" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="mb-3 flex justify-center">
                <button type="submit" class="button">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="naked-link self-center" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
        @include('layouts.error')
    </div>
</div>
@endsection
