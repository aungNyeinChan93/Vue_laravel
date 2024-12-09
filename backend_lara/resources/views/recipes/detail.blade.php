@extends('layout.layout')

@section('content')

<div class="container w-full h-screen px-10 mx-auto">
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 gap-4 md:grid-cols-4 md:items-center md:gap-8">
            <div class="md:col-span-3">
              <img
                src="{{ asset("$recipe->photo") }}"
                class="rounded"
                alt=""
              />
            </div>

            <div class="md:col-span-1">
              <div class="max-w-lg md:max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                 {{ $recipe->title }}
                </h2>

                <h5 class="text-red-300 text-lg my-1">Category -  {{ $recipe->category->name }}</h5>

                <p class="mt-4 text-gray-700 mb-6">
                  {{ $recipe->description }}
                </p>

                <a href="{{ route('recipes.index') }}" class="bg-green-400 hover:bg-green-200 rounded px-4 py-2 text-black">Back</a>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>

@endsection
