@extends('layout.layout')

@section('content')
    <div class="flex justify-between flex-col items-center">

        <div class=" my-3">
            {{-- category list --}}
            <div>
                <div class="sm:hidden">
                    <label for="Tab" class="sr-only">Tab</label>

                    <form id="categoryForm" action="{{ route('recipes.filter') }}" method="post">
                        @csrf
                        <select id="categorySelect" name="category" class="w-full rounded-md border-gray-200">

                            <option value="">All</option>
                            @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="hidden sm:block">
                    <nav class="flex gap-6" aria-label="Tabs">
                        <a href="{{ url('recipes?id=' . null . '') }}"
                            class="shrink-0 rounded-lg p-2 text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                            All
                        </a>
                        @foreach ($categories as $key => $category)
                            <a href="{{ url('recipes?id=' . $category->id . '') }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>
            {{-- category list end --}}
        </div>

        <div class="container  grid md:grid-cols-2 lg:grid-cols-4 mx-10 gap-5">
            @foreach ($recipes as $key => $recipe)
                <a href="{{ route('recipes.detail', $recipe->id) }}" class="group relative block bg-black">
                    <img alt=""
                        src="https://images.unsplash.com/photo-1603871165848-0aa92c869fa1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=772&q=80"
                        class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50" />

                    <div class="relative p-4 sm:p-6 lg:p-8">
                        <p class="text-sm font-medium uppercase tracking-widest text-pink-500">{{ $recipe->title }}</p>

                        <p class="text-xl font-bold text-white sm:text-2xl">{{ $recipe->category->name }}</p>

                        <div class="mt-32 sm:mt-48 lg:mt-64">
                            <div
                                class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                                <p class="text-sm text-white">
                                    {{ $recipe->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class=" px-3 py-5 my-5">
            {{ $recipes->links() }}
        </div>
    </div>

    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            document.getElementById('categoryForm').submit();
        });
    </script>



@endsection
