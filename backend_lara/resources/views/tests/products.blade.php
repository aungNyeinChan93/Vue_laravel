@extends('layout.layout')

@section('content')
    <div class="container px-10 mx-auto my-10">
        <h3 class="w-full text-center bg-green-500 rounded py-2 my-3 text-2xl text-white">Our Products</h3>
        <div class="grid lg:grid-cols-4 gap-6">
            @foreach ($products as $key => $product)
                <article class="relative overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <a href="#">
                        <img alt="" src="{{ $product->image }}" class="absolute inset-0 h-full w-full object-cover" />
                        <div class="relative bg-gradient-to-t from-gray-900/50 to-gray-900/25 pt-32 sm:pt-48 lg:pt-64">
                            <div class="p-4 sm:p-6">
                                <time datetime="2022-10-10" class="block text-xs text-white/90"> $ {{ $product->price }}
                                </time>

                                <a href="{{ route('fetch.productDetail', $product->id) }}">
                                    <h3 class="mt-0.5 text-lg text-white">{{ $product->title }}</h3>
                                </a>

                                <p class="mt-2 line-clamp-3 text-sm/relaxed text-white/95">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
@endsection
