<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-3xl sm:px-6 lg:px-8">
            <div class="bg-[#1f2937] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-100">
                    
                    <div class="mb-6">
                        <a href="{{ route('product.index') }}" class="text-gray-400 hover:text-white mr-2">
                            &lt; Back
                        </a>
                        <h2 class="text-2xl font-bold inline-block">Add Product</h2>
                        <p class="text-gray-400 text-sm mt-1">Fill in the details to add a new product</p>
                    </div>

                    <!-- BLOK ERROR (Biar ketahuan kalau gagal save kenapa) -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-900 border border-red-500 text-red-200 rounded-md">
                            <strong>Gagal menyimpan! Periksa isian berikut:</strong>
                            <ul class="list-disc pl-5 mt-2 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        
                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                   class="mt-1 block w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                   placeholder="Sepatu NIKE">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- Qty -->
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-300">qty <span class="text-red-500">*</span></label>
                                <input type="number" name="qty" id="qty" value="{{ old('qty') }}" 
                                       class="mt-1 block w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-300">Price (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                       class="mt-1 block w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-300">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" 
                                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('category_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Owner (User) Dropdown -->
                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-300">Owner <span class="text-red-500">*</span></label>
                            <select name="user_id" id="user_id" 
                                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Owner --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Action -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('product.index') }}" class="px-4 py-2 bg-transparent border border-gray-500 text-gray-300 rounded-md hover:bg-gray-700 mr-3 transition">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>