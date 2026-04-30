<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-[#242b3d] overflow-hidden shadow-xl sm:rounded-xl border border-gray-700/50">
                <div class="p-8 text-gray-100">
                    
                    <div class="mb-8">
                        <a href="{{ route('kategori.index') }}" class="text-gray-400 hover:text-white transition text-sm flex items-center gap-1 mb-3 w-fit">
                            <span>&lt;</span> Back to List
                        </a>
                        <h2 class="text-2xl font-bold text-white tracking-wide">Category Details</h2>
                        <p class="text-gray-400 text-sm mt-1">Detailed information about this category.</p>
                    </div>

                    <!-- Card Detail -->
                    <div class="bg-[#374151] rounded-lg p-6 mb-8 border border-gray-600/50">
                        <div class="mb-5">
                            <span class="block text-sm font-medium text-gray-400 mb-1">Category Name</span>
                            <!-- Perhatikan di sini kita pakai $kategori, bukan $category -->
                            <span class="text-xl font-bold text-white">{{ $kategori->name }}</span>
                        </div>
                        
                        <div>
                            <span class="block text-sm font-medium text-gray-400 mb-1">Created At</span>
                            <span class="text-md text-gray-300">
                                {{ $kategori->created_at ? $kategori->created_at->format('d M Y, H:i') : 'Unknown' }}
                            </span>
                        </div>
                    </div>

                    <!-- Tombol Action -->
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition shadow-md text-sm">
                            Edit Category
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>