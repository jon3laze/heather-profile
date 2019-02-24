@extends('layouts.app')

@section('content')
<div class="flex justify-center pb-2 py-2">
    <div class="w-1/3 sm:w-3/4">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="block text-blue text-sm font-bold mb-2">{{ __('Name') }}</label>

                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form-input" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="block text-blue text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-input" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="block text-blue text-sm font-bold mb-2">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-input" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-blue text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control form-input" name="password_confirmation" required>
            </div>

            <div class="mb-3 flex justify-center">
                <button type="submit" class="bg-blue shadow text-white font-mono text-sm py-2 px-4 rounded">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
