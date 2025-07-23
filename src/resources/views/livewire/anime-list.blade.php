<div>
    <x-layouts.app :title="'Daftar Anime'" :header="'Daftar Anime'">
        <div class="container mx-auto py-4 px-4">
            <!-- Tambah Alpine wrapper -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                x-data="{ openIndex: null }"
            >
                @foreach ($animes as $index => $anime)
                    <div class="bg-white shadow rounded-lg overflow-hidden">

                        <!-- Gambar: klik untuk toggle video -->
                        <img
                            src="{{ asset('storage/' . $anime->cover_image) }}"
                            alt="{{ $anime->title }}"
                            class="w-full h-64 object-cover cursor-pointer"
                            @click="openIndex === {{ $index }} ? openIndex = null : openIndex = {{ $index }}"
                        >

                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $anime->title }}</h2>
                            <p class="text-sm text-gray-600 mb-3">{{ $anime->description }}</p>

                            <!-- Video: hanya tampil jika sesuai index -->
                            <div x-show="openIndex === {{ $index }}" x-transition>
                                <video controls class="w-full h-48 rounded">
                                    <source src="{{ asset('storage/' . $anime->video_path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung video.
                                </video>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-layouts.app>
</div>
