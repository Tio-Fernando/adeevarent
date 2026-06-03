<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center mt-10">
        <div class="bg-white rounded-xl w-[400px] h-96 p-6 border border-gray-200 shadow-sm">

            <h2 class="text-2xl font-bold mb-8">Edit Kategori</h2>

           
            <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori
                    </label>

                    <input 
                        type="text" 
                        name="nama_kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        placeholder="Masukkan nama kategori"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    >

                    @error('nama_kategori')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-center items-center mt-40">
                    <button 
                        type="submit"
                        class="bg-primary hover:bg-accent text-white px-4 py-2 rounded-lg text-sm font-medium transition"
                    >
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>