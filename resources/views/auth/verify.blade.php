@extends('layouts.app')

@section('content')
<div class="flex justify-center pb-2 py-2">
    <div class="w-1/3 sm:w-3/4">
        <div class="mb-3">
            <h2 class="font-sans pb-2 text-blue">{{ __('Verify Your Email Address') }}</h2>
            <p class="font-serif text-sm text-grey">{{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}, <a class="naked-link" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.</p>
        </div>
        @if (session('resent'))
            <div class="alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
    </div>
</div>
@endsection
