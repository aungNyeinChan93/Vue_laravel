@extends('layout.layout')

@section('content')
<div class="flex justify-between flex-col items-center">

    {{-- create session --}}
    @if(Session::has('create'))
        <div role="alert" class="rounded-xl border border-gray-100 bg-white p-4">
            <div class="flex items-start gap-4">
                <span class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>

                <div class="flex-1">
                    <strong class="block font-medium text-gray-900"> Recipe Create success! </strong>

                    <p class="mt-1 text-sm text-gray-700">{{ session()->get('create') }}</p>
                </div>

                <button class="text-gray-500 transition hover:text-gray-600">
                    <span class="sr-only">Dismiss popup</span>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    {{-- create session end --}}
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
                    <a href="{{ url('recipes?id=' . null . '') }}" class="shrink-0 rounded-lg p-2 text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                        All
                    </a>
                    @foreach ($categories as $key => $category)
                    <a href="{{ url('recipes?id=' . $category->id . '') }}" class="shrink-0 rounded-lg p-2 text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </nav>
            </div>
        </div>
        {{-- category list end --}}


    </div>
    {{-- banner  --}}
    <div class="w-full container mx-auto px-5 my-2 py-3 rounded bg-green-600 flex justify-between items-center">
        <span class="text-4xl text-white font-mono ">Recipe</span>
        <span>
            <a class="px-3 py-2 my-2 text-green-800 rounded text-md bg-gray-200 hover:bg-gray-400 " href="{{ route('recipes.createPage') }}">Create Recipe</a>
        </span>
    </div>
    {{-- banner  --}}

    <div class="container  grid md:grid-cols-2 lg:grid-cols-4 mx-10 gap-5">
        @foreach ($recipes as $key => $recipe)
        <a href="{{ route('recipes.detail', $recipe->id) }}" class="group relative block bg-black">
            @if($recipe->photo)
            <img alt="" src="{{ asset("storage/$recipe->photo") }}" class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50" />
            @else
            <img alt="" src="{{ asset("$recipe->photo") }}" class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50" />
            @endif

            <div class="relative p-4 sm:p-6 lg:p-8">
                <p class="text-sm font-medium uppercase tracking-widest text-pink-500">{{ $recipe->title }}</p>

                <p class="text-xl font-bold text-white sm:text-2xl">{{ $recipe->category->name }}</p>

                <div class="mt-32 sm:mt-48 lg:mt-64">
                    <div class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
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
