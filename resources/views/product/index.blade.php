<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- HEADER --}}
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Product Management</h2>
                    <p class="text-gray-500 text-sm mt-1">Manage your inventory and stock levels.</p>
                </div>
                {{-- PERBAIKAN: Background Blue-600 Paksa --}}
                <a href="{{ route('product.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white !important font-bold py-2 px-6 rounded-lg shadow-lg transition duration-200 inline-flex items-center">
                    <span class="mr-2">+</span> Add New Product
                </a>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Product Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Qty</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Owner</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="bg-gray-200 px-2 py-1 rounded text-xs font-bold text-gray-700">
                                    {{ $product->quantity }} PCS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-green-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <div class="flex items-center">
                                    {{-- Avatar Bulat --}}
                                    <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-xs mr-3">
                                        {{ strtoupper(substr($product->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span>{{ $product->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    {{-- View --}}
                                    <a href="{{ route('product.show', $product->id) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    {{-- Edit --}}
                                    <a href="{{ route('product.edit', $product->id) }}" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    {{-- Delete --}}
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>