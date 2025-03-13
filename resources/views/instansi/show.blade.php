<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Hasil Survey</h2>
                <p class="text-gray-700"><strong>Nama Instansi:</strong> {{ $instansi->nama_instansi }}</p>

                <h3 class="text-xl font-semibold mt-6 mb-2">Data Hasil Terkait</h3>
                @if ($hasil->isEmpty())
                    <p class="text-gray-500">Belum ada hasil yang dikirim untuk instansi ini.</p>
                @else
                    <table class="w-full border border-gray-200 mt-2">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Kepuasan</th>
                                <th class="px-4 py-2 border">Pungutan</th>
                                <th class="px-4 py-2 border">Saran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $index => $item)
                                <tr class="border-b text-center">
                                    <td class="px-4 py-2 border text-center">
                                        {{ $loop->iteration + ($hasil->currentPage() - 1) * $hasil->perPage() }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('j F Y') }}
                                    </td>
                                    <td class="px-4 py-2 border">{{ $item->kepuasan }}</td>
                                    <td class="px-4 py-2 border">{{ $item->pungutan }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ $item->saran ? $item->saran : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $hasil->links('vendor.pagination.tailwind') }}
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('instansi.index') }}"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
