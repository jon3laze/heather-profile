@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @guest
            Nothing to see here...
        @else
            <a class="naked-link"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </div>
@endsection
