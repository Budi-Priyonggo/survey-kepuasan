<!DOCTYPE html>
<html lang="id">

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
</head>

<body class="font-sans antialiased bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Survey Tingkat Kepuasan</h2>
            <p class="text-gray-600 text-sm">Silakan isi data kepuasan dan pungutan sesuai dengan instansi</p>
        </div>

        <form method="POST" action="{{ route('hasil.store') }}">
            @csrf

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="bg-green-500 text-white p-3 rounded mb-4 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Pilih Instansi -->
            <div class="mb-4">
                <label for="instansi_id" class="block text-sm font-medium text-gray-700">Pilih Nama Instansi</label>
                <select name="instansi_id" id="instansi_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-50">
                    <option value="" disabled {{ old('instansi_id') == '' ? 'selected' : '' }}>Pilih Instansi
                    </option>
                    @foreach ($instansi as $item)
                        <option value="{{ $item->id }}" {{ old('instansi_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_instansi }}
                        </option>
                    @endforeach
                </select>
                @error('instansi_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Kepuasan -->
            <div class="mb-4">
                <label for="kepuasan" class="block text-sm font-medium text-gray-700">Tingkat Kepuasan</label>
                <select name="kepuasan" id="kepuasan"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-50">
                    <option value="" disabled {{ old('kepuasan') == '' ? 'selected' : '' }}>Pilih Tingkat Kepuasan
                    </option>
                    <option value="Sangat Puas" {{ old('kepuasan') == 'Sangat Puas' ? 'selected' : '' }}>Sangat Puas
                    </option>
                    <option value="Puas" {{ old('kepuasan') == 'Puas' ? 'selected' : '' }}>Puas</option>
                    <option value="Cukup Puas" {{ old('kepuasan') == 'Cukup Puas' ? 'selected' : '' }}>Cukup Puas
                    </option>
                    <option value="Tidak Puas" {{ old('kepuasan') == 'Tidak Puas' ? 'selected' : '' }}>Tidak Puas
                    </option>
                </select>
                @error('kepuasan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Pungutan -->
            <div class="mb-4">
                <label for="pungutan" class="block text-sm font-medium text-gray-700">Apakah Ada Pungutan?</label>
                <select name="pungutan" id="pungutan"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-50">
                    <option value="" disabled {{ old('pungutan') == '' ? 'selected' : '' }}>Pilih Status Pungutan
                    </option>
                    <option value="Ada" {{ old('pungutan') == 'Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada" {{ old('pungutan') == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                </select>
                @error('pungutan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="saran" class="block text-sm font-medium text-gray-700">Masukkan Kritik dan Saran
                    (Opsional)</label>
                <textarea name="saran" id="saran" rows="5"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-50"
                    placeholder="Tulis kritik dan saran Anda di sini..." oninput="updateCharacterCount()">{{ old('saran') }}</textarea>
                @error('saran')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div id="character-count" class="mt-2 text-sm text-green-600">0 Karakter</div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>

<script>
    function updateCharacterCount() {
        const saran = document.getElementById('saran');
        const characterCount = document.getElementById('character-count');

        // Remove spaces from the text
        const currentLength = saran.value.replace(/\s+/g, '').length;

        // Update character count
        characterCount.textContent = `${currentLength} Karakter`;

        // Change color based on character length
        if (currentLength > 100) {
            characterCount.classList.remove('text-green-600');
            characterCount.classList.add('text-red-600');
        } else {
            characterCount.classList.remove('text-red-600');
            characterCount.classList.add('text-green-600');
        }
    }
</script>


</html>
