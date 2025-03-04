<div class="min-h-screen bg-base-200 dark:bg-gray-900 flex flex-col">
    <!-- Wallpaper Fullscreen -->
    <div class="relative w-full h-screen">
        <img src="{{ asset('storage/'.$wallpaper->image_url) }}" 
            alt="{{ $wallpaper->title }}" 
            class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradien untuk transisi ke konten -->
        <div class="absolute bottom-0 w-full h-40 bg-gradient-to-t from-base-200 dark:from-gray-900 to-transparent"></div>
    </div>

    <!-- Detail & Actions -->
    <div class="container mx-auto px-6 lg:px-12 py-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-gray-100">{{ $wallpaper->title }}</h1>
        <p class="text-lg mt-3 max-w-2xl mx-auto text-gray-700 dark:text-gray-300">{{ $wallpaper->description }}</p>

        <!-- Kategori -->
        <span class="mt-4 inline-block bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-gray-300 text-sm font-medium px-4 py-2 rounded-full">
            {{ $wallpaper->category->name ?? 'Uncategorized' }}
        </span>

        <!-- Tombol Download & Kembali -->
        <div class="mt-6 flex justify-center space-x-4">
            <button wire:click="download" class="btn btn-primary btn-lg shadow-lg transition-all duration-300 hover:scale-105">
                Download
            </button>
            <a href="/" class="btn btn-outline btn-lg dark:text-gray-200 transition-all duration-300 hover:scale-105">
                Back
            </a>
        </div>
    </div>
</div>
