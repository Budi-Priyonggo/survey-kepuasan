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

    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
            /* Untuk menyembunyikan scrollbar di Chrome, Safari, dan Opera */
        }

        .scrollbar-hidden {
            -ms-overflow-style: none;
            /* Untuk Internet Explorer 10+ */
            scrollbar-width: none;
            /* Untuk Firefox */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                    <!-- Ringkasan Statistik -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Rangkuman Statistik</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Tingkat Kepuasan -->
                            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                                <h4 class="font-semibold text-lg text-blue-600 mb-3 flex items-center">
                                    <i class="fas fa-smile mr-2"></i>Tingkat Kepuasan
                                </h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2">😍</span> Sangat
                                            Puas</span>
                                        <span
                                            class="font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['kepuasan']['Sangat Puas'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2">😊</span> Puas</span>
                                        <span
                                            class="font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['kepuasan']['Puas'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2">😐</span> Cukup
                                            Puas</span>
                                        <span
                                            class="font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['kepuasan']['Cukup Puas'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2">😠</span> Tidak
                                            Puas</span>
                                        <span
                                            class="font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['kepuasan']['Tidak Puas'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pungutan -->
                            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                                <h4 class="font-semibold text-lg text-blue-600 mb-3 flex items-center">
                                    <i class="fas fa-hand-holding-usd mr-2"></i>Pungutan
                                </h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2"><i class="fa-solid fa-handshake"></i></span> Ada
                                            Pungutan</span>
                                        <span
                                            class="font-semibold bg-red-100 text-red-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['pungutan']['Ada'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><span class="text-xl mr-2"><i class="fa-solid fa-handshake-slash"></i></span> Tidak Ada
                                            Pungutan</span>
                                        <span
                                            class="font-semibold bg-green-100 text-green-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['pungutan']['Tidak Ada'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Total & Saran -->
                            <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                                <h4 class="font-semibold text-lg text-blue-600 mb-3 flex items-center">
                                    <i class="fas fa-chart-pie mr-2"></i>Ringkasan
                                </h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><i class="fas fa-users mr-2"></i> Total
                                            Responden</span>
                                        <span
                                            class="font-semibold bg-purple-100 text-purple-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['total'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="flex items-center"><i class="fas fa-comment-dots mr-2"></i> Total
                                            Kritik & Saran</span>
                                        <span
                                            class="font-semibold bg-purple-100 text-purple-800 px-2 py-1 rounded w-7 h-8 text-center inline-block">{{ $statistics['total_saran'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Tabel -->
                    <h3 class="text-xl font-semibold mt-4 mb-3 text-gray-800">Data Hasil Terkait</h3>
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="w-16 px-4 py-3 text-center text-xs font-semibold uppercase border">No
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Kepuasan
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Pungutan
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase border">Kritik dan
                                        Saran</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($hasil as $index => $item)
                                    <tr class="border-b hover:bg-gray-100 transition-all">
                                        <td class="text-center px-6 py-4 border">
                                            {{ $loop->iteration + ($hasil->currentPage() - 1) * $hasil->perPage() }}
                                        </td>
                                        <td class="text-center px-6 py-4 border">
                                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('j F Y') }}
                                        </td>
                                        <td class="text-center px-6 py-4 border">{{ $item->kepuasan }}</td>
                                        <td class="text-center px-6 py-4 border">{{ $item->pungutan }}</td>
                                        <td class="text-center px-6 py-4 border">{{ $item->saran ?: '-' }}</td>
                                    </tr>
                                @empty
                                    @if (request()->filled(['start_date', 'end_date']))
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                <img src="{{ asset('images/not-found.png') }}"
                                                    alt="No Search Results" class="mx-auto w-[200px] h-[200px]">
                                                <p class="mt-4">Data hasil survey tidak ditemukan untuk rentang
                                                    tanggal yang dipilih.</p>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                <img src="{{ asset('images/empty.png') }}" alt="No Data Found"
                                                    class="mx-auto w-[200px] h-[200px]">
                                                <p class="mt-4">Belum ada data hasil survey yang dikirim.</p>
                                            </td>
                                        </tr>
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $hasil->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>

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
