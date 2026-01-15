<div class="group bg-white dark:bg-surface-dark rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg hover:border-primary-orange transition-all duration-300">
    <div class="aspect-[4/3] bg-gray-100 dark:bg-gray-800 overflow-hidden relative">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    
    <div class="p-4">
        <div class="flex justify-between items-start mb-2">
            <h4 class="font-bold text-gray-900 dark:text-white line-clamp-1 text-sm">{{ $title }}</h4>
            <span class="text-primary-orange font-bold text-xs whitespace-nowrap ml-2">{{ $price }}</span>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">{{ $description }}</p>
    </div>
</div>