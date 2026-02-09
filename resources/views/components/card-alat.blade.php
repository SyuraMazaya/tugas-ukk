@props([
    'alat',
])

<div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
        @if($alat->gambar)
            <img 
                src="{{ asset('storage/' . $alat->gambar) }}" 
                alt="{{ $alat->nama_alat }}"
                class="w-full h-48 object-cover"
            >
        @else
            <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif
    </div>
    
    <div class="p-4">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900 truncate">{{ $alat->nama_alat }}</h3>
                <p class="text-sm text-gray-500">{{ $alat->kode_alat }}</p>
            </div>
            <x-badge :status="$alat->kondisi" />
        </div>
        
        <div class="mt-3 flex items-center justify-between">
            <span class="text-sm text-gray-600">
                {{ $alat->kategori->nama_kategori }}
            </span>
            <span class="text-sm font-medium {{ $alat->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                Stok: {{ $alat->stok }}
            </span>
        </div>
    </div>
</div>