@if (session('success'))
    <div
        class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-200 flex items-center gap-3 shadow-sm animate-fade-in">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div
        class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200 flex items-center gap-3 shadow-sm animate-fade-in">
        <span class="material-symbols-outlined">error</span>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif

@if (session('warning'))
    <div
        class="mb-6 p-4 bg-yellow-50 text-yellow-700 rounded-xl border border-yellow-200 flex items-center gap-3 shadow-sm animate-fade-in">
        <span class="material-symbols-outlined">warning</span>
        <span class="font-medium">{{ session('warning') }}</span>
    </div>
@endif

@if (session('info'))
    <div
        class="mb-6 p-4 bg-blue-50 text-blue-700 rounded-xl border border-blue-200 flex items-center gap-3 shadow-sm animate-fade-in">
        <span class="material-symbols-outlined">info</span>
        <span class="font-medium">{{ session('info') }}</span>
    </div>
@endif
