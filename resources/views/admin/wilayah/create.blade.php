<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah wilayah') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center mt-10">
        <div class="bg-white rounded-xl w-[400px]  h-96 p-6 border border-gray-200 shadow-sm">

            <h2 class="text-2xl font-bold mb-8">Tambah wilayah</h2>
            <!-- Form -->
            <form action="{{ route('wilayah.store') }}" method="POST">
                @csrf

           
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                     Lokasi
                    </label>

                    <input 
                        type="text" 
                        name="lokasi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        placeholder="Masukkan lokasi"
                        value="{{ old('lokasi') }}"
                    >

                 
                    @error('lokasi')
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
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>