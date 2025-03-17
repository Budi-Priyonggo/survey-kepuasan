<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <style>
         * {
            border: 1px solid black;
        }
    </style> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Hasil Survey</h2>
                        <p class="text-gray-700 mt-2 md:mt-0">
                            <strong>Nama Instansi:</strong> {{ $instansi->nama_instansi }}
                        </p>
                    </div>

                    <!-- Form Filter -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm mb-6">
                        <form method="GET" action="{{ route('instansi.show', $instansi->id) }}"
                            class="flex flex-wrap gap-2 items-center justify-center">
                            <div>
                                <label for="start_date" class="text-sm font-semibold text-gray-600">Dari
                                    Tanggal:</label>
                                <input type="date" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}"
                                    class="border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-300">
                            </div>
                            <div>
                                <label for="end_date" class="text-sm font-semibold text-gray-600">Sampai
                                    Tanggal:</label>
                                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                                    class="border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-300">
                            </div>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none">
                                Filter
                            </button>
                            <a href="{{ route('instansi.show', $instansi->id) }}"
                                class="px-4 py-2 bg-yellow-400 text-white font-semibold rounded-md hover:bg-yellow-500 focus:outline-none">
                                Clear Filter
                            </a>
                        </form>

                        @if ($errors->has('end_date'))
                            <p class="text-red-500 text-sm mt-2 text-center">{{ $errors->first('end_date') }}</p>
                        @endif
                    </div>

                    {{-- <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Hasil Survey</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg shadow-md">
                                <h4 class="font-semibold text-gray-700">Jumlah Kepuasan</h4>
                                <p class="text-lg text-gray-800">Puas: {{ $jumlahKepuasan['puas'] }}</p>
                                <p class="text-lg text-gray-800">Cukup: {{ $jumlahKepuasan['cukup'] }}</p>
                                <p class="text-lg text-gray-800">Tidak Puas: {{ $jumlahKepuasan['kurang'] }}</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg shadow-md">
                                <h4 class="font-semibold text-gray-700">Jumlah Pungutan</h4>
                                <p class="text-lg text-gray-800">Ada: {{ $jumlahPungutan['ya'] }}</p>
                                <p class="text-lg text-gray-800">Tidak ada: {{ $jumlahPungutan['tidak'] }}</p>
                            </div>
                            <div class="bg-yellow-50 p-4 rounded-lg shadow-md">
                                <h4 class="font-semibold text-gray-700">Jumlah Saran</h4>
                                <p class="text-lg text-gray-800">{{ $jumlahSaran }} saran diterima</p>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Data Tabel -->
                    <h3 class="text-xl font-semibold mt-4 mb-3 text-gray-800">Data Hasil Terkait</h3>
                    @if ($hasil->isEmpty())
                        <img src="{{ asset('images/empty.png') }}" alt="No Data Found"
                            class="mx-auto w-[200px] h-[200px]">
                        <p class="text-gray-500 text-center">Belum ada hasil yang dikirim untuk instansi ini.</p>
                    @else
                        <div class="overflow-hidden">
                            <table class="w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="w-16 px-4 py-3 text-center text-xs font-semibold uppercase border">No
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">
                                            Kepuasan</th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">
                                            Pungutan</th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Kritik
                                            dan Saran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($hasil as $index => $item)
                                        <tr class="border-b hover:bg-gray-100 transition-all">
                                            <!-- Nomor urut dengan pagination -->
                                            <td class="text-center px-6 py-4 border">
                                                {{ $loop->iteration + ($hasil->currentPage() - 1) * $hasil->perPage() }}
                                            </td>

                                            <!-- Format Tanggal -->
                                            <td class="text-center px-6 py-4 border">
                                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('j F Y') }}
                                            </td>

                                            <td class="text-center px-6 py-4 border">{{ $item->kepuasan }}</td>
                                            <td class="text-center px-6 py-4 border">{{ $item->pungutan }}</td>

                                            <!-- Menampilkan Saran (Jika tidak ada, tampilkan "-") -->
                                            <td class="text-center px-6 py-4 border">
                                                {{ $item->saran ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 flex justify-center">
                            {{ $hasil->appends(request()->query())->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif

                    <!-- Tombol Kembali -->
                    <div class="mt-6 flex justify-start ">
                        <a href="{{ route('instansi.index') }}"
                            class="px-5 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
