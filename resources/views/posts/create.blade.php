@extends('layouts.app')

@section('content')
    <div class="max-w-md w-full lg:flex mx-auto">
        <div class="bg-white m-2 p-4 flex flex-col justify-between leading-normal shadow">
            <div class="mb-2">
                <form method="POST" action="/posts">
                    @csrf
                    <div class="mb-2">
                        <label for="title" class="block text-blue text-sm font-bold mb-2">{{ __('Title') }}</label>

                        <input id="title"
                            type="text"
                            class="form-control form-input"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="category_id" class="block text-blue text-sm font-bold mb-2">{{ __('Category') }}</label>

                        <select class="form-control form-input"
                            id="category_id"
                            name="category_id"
                            required>
                            <option value="">Select a category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? "selected" : "" }}
                                    >{{ $category->name }}</option>
                                    }
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="block text-blue text-sm font-bold mb-2">{{ __('Body') }}</label>

                        <textarea id="body"
                            class="form-control form-input"
                            name="body"
                            rows="10"
                            required>{{ old('body') }}</textarea>
                    </div>
                    <div class="mb-2 flex justify-end">
                        <button type="submit" class="button">
                            {{ __('Post') }}
                        </button>
                    </div>
                </form>
            </div>

            @include('layouts.error')
        </div>
    </div>
@endsection
