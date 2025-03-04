<section class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-gray-100 to-white dark:from-gray-800 dark:to-gray-900 m-h-c">
        <div class="grid max-w-screen-xl px-4 py-16 mx-auto lg:gap-12 xl:gap-0 lg:grid-cols-12 items-center">
            <!-- Text -->
            <div class="mr-auto place-self-center lg:col-span-7 animate-fadeIn">
                <h1 class="text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Discover Stunning Wallpapers
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Explore a curated collection of breathtaking wallpapers. Elevate your screen with high-quality images.
                </p>
                <div class="mt-6">
                    <a href="#gallery"
                        class="px-6 py-3 text-white bg-blue-600 rounded-lg shadow-lg transition-all duration-300 hover:bg-blue-700 hover:scale-105">
                        Explore Now
                    </a>
                </div>
            </div>
            <!-- Image -->
            <div class="hidden lg:col-span-5 lg:flex animate-fadeInRight">
                <img src="{{ asset('favicon.ico') }}" 
                    class="w-full h-auto object-cover rounded-2xl shadow-lg hover:scale-105 transition-all duration-300"
                    alt="mockup">
            </div>
        </div>
    </section>

    <!-- Filter Categories -->
    <div class="container mx-auto flex flex-wrap justify-center py-6 gap-4">
        <button wire:click="filterByCategory(null)" wire:loading.attr="disabled"
            class="btn btn-secondary btn-outline rounded-full transition-all duration-300 hover:bg-blue-500 hover:text-white hover:scale-105">
            All Categories
        </button>
        @forelse ($categories as $category)
            <button wire:click="filterByCategory({{ $category->id }})" wire:loading.attr="disabled"
                class="btn btn-primary btn-outline rounded-full transition-all duration-300 hover:bg-blue-500 hover:text-white hover:scale-105">
                {{ $category->name }}
            </button>
        @empty
            <p class="text-gray-500 dark:text-gray-300">No categories found.</p>
        @endforelse
    </div>

    <!-- Gallery Section -->
    <div id="gallery" class="container mx-auto px-6 lg:px-12 py-10">
        <!-- Skeleton Loader (Saat loading) -->
        <div wire:loading wire:target="filterByCategory"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @for ($i = 0; $i < 8; $i++)
                <div class="w-full flex flex-col space-y-3 animate-pulse">
                    <div class="w-full h-64 bg-gray-300 rounded-lg dark:bg-gray-700"></div>
                    <div class="w-3/4 h-4 bg-gray-300 rounded"></div>
                    <div class="w-1/2 h-4 bg-gray-300 rounded"></div>
                </div>
            @endfor
        </div>

        <!-- Gallery Section (Saat data siap) -->
        <div wire:loading.remove
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($wallpapers as $wallpaper)
                <div class="relative group transition-all duration-300 hover:scale-105 hover:shadow-2xl rounded-lg overflow-hidden">
                    <a href="{{ route('home.detail', $wallpaper->slug) }}">
                        <img class="w-full h-64 object-cover rounded-lg"
                            src="{{ asset('storage/' . $wallpaper->image_url) }}" alt="{{ $wallpaper->title }}">
                        <!-- Overlay saat hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex justify-center items-center transition-opacity duration-300">
                            <span class="text-white text-lg font-semibold">View Details</span>
                        </div>
                    </a>
                    <p class="text-lg font-semibold text-center mt-2 text-gray-800 dark:text-gray-200">{{ $wallpaper->title }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-300 col-span-full">No wallpapers found.</p>
            @endforelse
        </div>
    </div>
</section>
