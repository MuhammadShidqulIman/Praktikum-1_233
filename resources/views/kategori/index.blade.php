<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header & Button Add -->
            <div class="flex justify-between items-center mb-6 px-2 sm:px-0">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Category Management</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage your product categories and classifications.</p>
                </div>
                <a href="{{ route('kategori.create') }}" class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm text-sm flex items-center gap-2">
                    <span>+</span> Add New Category
                </a>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">#</th>
                                <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category Name</th>
                                <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Product</th>
                                <th class="px-8 py-5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-40">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-50">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $category->name }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <!-- Badge Style seperti 'PCS' -->
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-md bg-gray-200 text-gray-700">
                                        {{ $category->products_count }} Items
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium flex justify-center gap-3">
                                    
                                    <!-- View Button (Blue) -->
                                    <a href="{{ route('kategori.show', $category->id) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>

                                    <!-- Edit Button (Yellow) -->
                                    <a href="{{ route('kategori.edit', $category->id) }}" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <!-- Delete Button (Red) -->
                                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-10 text-center text-gray-500">
                                    Belum ada kategori yang ditambahkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>