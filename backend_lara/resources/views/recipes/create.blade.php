@extends('layout.layout')

@section('content')

<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
        <h1 class="text-2xl font-bold sm:text-3xl">Get started Taste!</h1>

        <p class="mt-4 text-gray-500">
            Create Recipes
        </p>
    </div>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
        @csrf
        <div>
            <label for="title" class="sr-only">title</label>
            <div class="relative">
                <input type="title" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter title" name="title"  value="{{ old('title')  }}"/>
            </div>
            @error('title')
            <div role="alert" class="my-1 rounded border-s-4 border-red-500 bg-red-50 p-4">
                <div class="flex items-center gap-2 text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                    <strong class="block font-medium"> {{ $message }}</strong>
                </div>
            </div>
            @enderror
        </div>

        <div>
            <label for="description" class="sr-only">description</label>
            <div class="relative">
                <textarea name="description" rows="8" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Enter description"> {{ old('description') }}</textarea>
            </div>
            @error('description')
            <div role="alert" class="my-1 rounded border-s-4 border-red-500 bg-red-50 p-4">
                <div class="flex items-center gap-2 text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                    <strong class="block font-medium"> {{ $message }}</strong>
                </div>
            </div>
            @enderror
        </div>

        <div>
            <select name="category_id" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
                <option value="all">Choose Category</option>

                @foreach($categories as $key => $category)
                    <option value="{{ $category->id }}" @if( old('category_id') == $category->id)
                        selected
                    @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div role="alert" class="my-1 rounded border-s-4 border-red-500 bg-red-50 p-4">
                <div class="flex items-center gap-2 text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                    <strong class="block font-medium"> {{ $message }}</strong>
                </div>
            </div>
            @enderror
        </div>

        <div>
            <input type="file" name="photo" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm">
            @error('photo')
            <div role="alert" class="my-1 rounded border-s-4 border-red-500 bg-red-50 p-4">
                <div class="flex items-center gap-2 text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                    <strong class="block font-medium"> {{ $message }}</strong>
                </div>
            </div>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
                No account?
                <a class="underline" href="#">Sign up</a>
            </p>

            <button type="submit" class="inline-block rounded-lg bg-green-500 px-5 py-3 text-sm font-medium text-white">
                Create
            </button>
        </div>
    </form>
</div>
@endsection
