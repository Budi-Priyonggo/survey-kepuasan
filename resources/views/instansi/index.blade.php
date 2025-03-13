<x-app-layout>
    <div class="py-12" x-data="{ openAddModal: false, openEditModal: false, openDeleteModal: false, editId: '', editNama: '', deleteId: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show"
                            class="bg-green-500 text-white p-3 rounded mb-4 flex justify-between items-center">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="text-white font-bold px-2">x</button>
                        </div>
                    @endif

                    @if (session('edit'))
                        <div x-data="{ show: true }" x-show="show"
                            class="bg-yellow-500 text-white p-3 rounded mb-4 flex justify-between items-center">
                            <span>{{ session('edit') }}</span>
                            <button @click="show = false" class="text-white font-bold px-2">x</button>
                        </div>
                    @endif

                    @if (session('delete'))
                        <div x-data="{ show: true }" x-show="show"
                            class="bg-red-500 text-white p-3 rounded mb-4 flex justify-between items-center">
                            <span>{{ session('delete') }}</span>
                            <button @click="show = false" class="text-white font-bold px-2">x</button>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">List Instansi</h3>
                        <button @click="openAddModal = true"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all">
                            Tambah Instansi
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th
                                        class="w-16 px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase border">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase border">
                                        Nama Instansi</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase border">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($instansi as $index => $item)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="text-center px-6 py-4 border">{{ $index + 1 }}</td>
                                        <td class="text-center px-6 py-4 border">{{ $item->nama_instansi }}</td>
                                        <td class="px-6 py-4 border text-center space-x-2">
                                            <button
                                                @click="openEditModal = true; editId = '{{ $item->id }}'; editNama = '{{ $item->nama_instansi }}'"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-all">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button @click="openDeleteModal = true; deleteId = '{{ $item->id }}'"
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <button
                                                class="px-3 py-1 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-all">
                                                <a href="{{ route('instansi.show', $item->id) }}">
                                                    <a href="{{ route('instansi.show', $item->id) }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </a>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada
                                            instansi yang tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <div class="mt-6 flex justify-center">
                            {{ $instansi->links('vendor.pagination.tailwind') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div x-show="openAddModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50"
            x-cloak>
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Tambah Instansi</h2>
                <form method="POST" action="{{ route('instansi.store') }}">
                    @csrf

                    <!-- Input Nama Instansi -->
                    <input type="text" name="nama_instansi"
                        class="w-full border p-2 rounded mb-2 @error('nama_instansi') border-red-500 @enderror"
                        placeholder="Nama Instansi" value="{{ old('nama_instansi') }}">
                    @error('nama_instansi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror


                    

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="openAddModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div x-show="openEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50"
            x-cloak>
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Edit Instansi</h2>
                <form method="POST" :action="'/instansi/' + editId">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Instansi -->
                    <input type="text" name="nama_instansi" x-model="editNama"
                        class="w-full border p-2 rounded mb-2 @error('nama_instansi') border-red-500 @enderror">

                    <!-- Pesan Error -->
                    @error('nama_instansi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" @click="openEditModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal Konfirmasi Hapus -->
        <div x-show="openDeleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50"
            x-cloak>
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Konfirmasi Hapus</h2>
                <p>Apakah Anda yakin ingin menghapus instansi ini?</p>
                <form method="POST" :action="'/instansi/' + deleteId" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="openDeleteModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
