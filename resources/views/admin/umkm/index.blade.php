@extends('layouts.admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen UMKM</h1>
            <p class="text-gray-500">Kelola status dan data mitra UMKM.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 font-medium">
                    <tr>
                        <th class="px-6 py-4">Nama Usaha</th>
                        <th class="px-6 py-4">Pemilik</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($umkms as $umkm)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $umkm->nama_usaha }}</div>
                                <div class="text-xs text-gray-400">{{ $umkm->email }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $umkm->nama_pemilik }}</td>
                            <td class="px-6 py-4">
                                @if ($umkm->status == 'pending')
                                    <span
                                        class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold">Pending</span>
                                @elseif($umkm->status == 'approved')
                                    <span
                                        class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">Aktif</span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('umkm.show', $umkm->slug) }}" target="_blank"
                                    class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200" title="Lihat Profil">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </a>

                                @if ($umkm->status == 'pending')
                                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200"
                                            title="Setujui">
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST"
                                        onsubmit="return confirm('Tolak UMKM ini?')">
                                        @csrf @method('PUT')
                                        <button class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200"
                                            title="Tolak">
                                            <span class="material-symbols-outlined text-sm">close</span>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $umkms->links() }}
        </div>
    </div>
@endsection
