@extends('layout.layout')

@section('content')
    <div class="container px-10 mx-auto my-10 ">

        <section >
            <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4 md:items-center md:gap-8">
                    <div class="md:col-span-3">
                        <img src="{{ $product->image }}"
                            class="rounded" alt="" />
                    </div>

                    <div class="md:col-span-1">
                        <div class="max-w-lg md:max-w-none">
                            <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                                {{ $product->title }}
                            </h2>

                            <p class="mt-4 text-gray-700">
                                {{ $product->description }}
                            </p>
                            <div class="my-4">
                                <a href="{{ route('fetch.products') }}" class="bg-green-400 rounded px-4 py-2 text-white my-4 hover:bg-green-300">Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
