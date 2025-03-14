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

    <style>
        body {
            background-image: url('https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/simple-icons.svg'), linear-gradient(135deg, #6366f1 0%, #3b82f6 50%, #2dd4bf 100%);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .header-survey {
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-survey::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTYwIiBoZWlnaHQ9IjU2MCIgdmlld0JveD0iMCAwIDU2MCA1NjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjgwIDI4MCkiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICA8Y2lyY2xlIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKSIgY3g9IjAiIGN5PSIwIiByPSIyODAiLz4KICAgIDxjaXJjbGUgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpIiBjeD0iMCIgY3k9IjAiIHI9IjI0MCIvPgogICAgPGNpcmNsZSBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiIGN4PSIwIiBjeT0iMCIgcj0iMjAwIi8+CiAgICA8Y2lyY2xlIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xKSIgY3g9IjAiIGN5PSIwIiByPSIxNjAiLz4KICAgIDxjaXJjbGUgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjEpIiBjeD0iMCIgY3k9IjAiIHI9IjEyMCIvPgogICAgPGNpcmNsZSBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMSkiIGN4PSIwIiBjeT0iMCIgcj0iODAiLz4KICA8L2c+Cjwvc3ZnPg==');
            background-size: cover;
            opacity: 0.2;
        }

        .emoji-card {
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .emoji-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .form-section {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 0.75rem;
            border: 1px solid rgba(209, 213, 219, 0.5);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .form-section:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #4f46e5;
            font-weight: 600;
        }

        .section-title i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .submit-button {
            background-image: linear-gradient(to right, #4f46e5, #3b82f6);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .submit-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transition: width 0.3s ease;
        }

        .submit-button:hover::after {
            width: 100%;
        }

        .select-instansi {
            background-image: linear-gradient(to bottom, #f9fafb, #f3f4f6);
            border-color: #e5e7eb;
            transition: all 0.3s ease;
        }

        .select-instansi:focus {
            background-image: linear-gradient(to bottom, #f0f9ff, #e0f2fe);
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .textarea-saran {
            background-image: linear-gradient(to bottom, #f9fafb, #f3f4f6);
            border-color: #e5e7eb;
            transition: all 0.3s ease;
            resize: none;
        }

        .textarea-saran:focus {
            background-image: linear-gradient(to bottom, #f0f9ff, #e0f2fe);
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .emoji-float {
            animation: float 2s ease-in-out infinite;
        }

        @media (max-width: 640px) {
            .header-survey {
                margin: -1rem -1rem 1rem -1rem;
                padding: 1rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-2xl form-container p-6">
        <div class="header-survey text-center mb-6">
            <h2 class="text-3xl font-bold text-black">Survey Tingkat Kepuasan</h2>
            <p class="text-gray-600 mt-2">Silakan isi data kepuasan dan pungutan sesuai dengan instansi</p>
        </div>

        <form method="POST" action="{{ route('hasil.store') }}">
            @csrf

            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                    class="bg-green-500 text-white p-4 rounded-lg mb-6 flex justify-between items-center shadow-md transform transition-all duration-500"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Pilih Instansi -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-building"></i>
                    <span>Pilih Nama Instansi</span>
                </div>
                <select name="instansi_id" id="instansi_id"
                    class="select-instansi block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="" disabled {{ old('instansi_id') == '' ? 'selected' : '' }}>-- Pilih Instansi
                        --
                    </option>
                    @foreach ($instansi as $item)
                        <option value="{{ $item->id }}" {{ old('instansi_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_instansi }}
                        </option>
                    @endforeach
                </select>
                @error('instansi_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Pilih Kepuasan dengan Emoji -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-smile"></i>
                    <span>Tingkat Kepuasan</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kepuasan" value="Sangat Puas" class="sr-only peer"
                            {{ old('kepuasan') == 'Sangat Puas' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">😍</span>
                            <span class="text-sm font-medium text-center">Sangat Puas</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kepuasan" value="Puas" class="sr-only peer"
                            {{ old('kepuasan') == 'Puas' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">😊</span>
                            <span class="text-sm font-medium text-center">Puas</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kepuasan" value="Cukup Puas" class="sr-only peer"
                            {{ old('kepuasan') == 'Cukup Puas' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">😐</span>
                            <span class="text-sm font-medium text-center">Cukup Puas</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="kepuasan" value="Tidak Puas" class="sr-only peer"
                            {{ old('kepuasan') == 'Tidak Puas' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-blue-50 peer-checked:border-blue-500 peer-checked:bg-blue-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">😠</span>
                            <span class="text-sm font-medium text-center">Tidak Puas</span>
                        </div>
                    </label>
                </div>
                @error('kepuasan')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Pilih Pungutan dengan Emoji -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Apakah Ada Pungutan?</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="pungutan" value="Ada" class="sr-only peer"
                            {{ old('pungutan') == 'Ada' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">💸</span>
                            <span class="text-sm font-medium text-center">Ada Pungutan</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="pungutan" value="Tidak Ada" class="sr-only peer"
                            {{ old('pungutan') == 'Tidak Ada' ? 'checked' : '' }}>
                        <div
                            class="emoji-card flex flex-col items-center justify-center border-2 border-gray-200 rounded-xl p-4 hover:bg-green-50 peer-checked:border-green-500 peer-checked:bg-green-100 transition-all duration-200">
                            <span class="text-4xl mb-2 emoji-float">✅</span>
                            <span class="text-sm font-medium text-center">Tidak Ada Pungutan</span>
                        </div>
                    </label>
                </div>
                @error('pungutan')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Kritik dan Saran -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-comment-dots"></i>
                    <span>Kritik dan Saran (Opsional)</span>
                </div>
                <textarea name="saran" id="saran" rows="4"
                    class="textarea-saran block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Tulis kritik dan saran Anda di sini..." oninput="updateCharacterCount()">{{ old('saran') }}</textarea>
                @error('saran')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
                <div id="character-count" class="mt-2 text-sm text-green-600 flex items-center">
                    <i class="fas fa-keyboard mr-1"></i>
                    <span>0 Karakter</span>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="submit-button px-6 py-3 text-white rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    <span>Kirim Survei</span>
                </button>
            </div>
        </form>
    </div>

</body>

<script>
    function updateCharacterCount() {
        const saran = document.getElementById('saran');
        const characterCount = document.getElementById('character-count');
        const countSpan = characterCount.querySelector('span');

        // Menghitung panjang karakter termasuk spasi
        const currentLength = saran.value.length;

        // Update count karakter
        countSpan.textContent = `${currentLength} Karakter`;

        // Mengubah warna berdasarkan panjang karakter
        if (currentLength > 100) {
            characterCount.classList.remove('text-green-600');
            characterCount.classList.add('text-red-600');
        } else {
            characterCount.classList.remove('text-red-600');
            characterCount.classList.add('text-green-600');
        }
    }
    // Add animation to success message
    document.addEventListener('DOMContentLoaded', function() {
        const selectInstansi = document.getElementById('instansi_id');
        if (selectInstansi) {
            selectInstansi.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-blue-300');
            });
            selectInstansi.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-blue-300');
            });
        }
    });
</script>

</html>
