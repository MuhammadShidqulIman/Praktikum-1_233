<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-[#242b3d] overflow-hidden shadow-xl sm:rounded-xl border border-gray-700/50">
                <div class="p-8 text-gray-100">
                    
                    <div class="mb-8">
                        <a href="{{ route('kategori.index') }}" class="text-gray-400 hover:text-white transition text-sm flex items-center gap-1 mb-3 w-fit">
                            <span>&lt;</span> Back
                        </a>
                        <h2 class="text-2xl font-bold text-white tracking-wide">Edit Category</h2>
                        <p class="text-gray-400 text-sm mt-1">Update the details of the category</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 text-red-400 rounded-lg text-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-8">
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Category Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $kategori->name) }}" 
                                   class="block w-full bg-[#374151] border-transparent text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-4">
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-8">
                            <a href="{{ route('kategori.index') }}" class="px-5 py-2.5 bg-transparent border border-gray-500 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-md">
                                Update Category
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>