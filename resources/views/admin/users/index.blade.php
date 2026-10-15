@extends('layouts.admin')

@section('title', 'Manajemen Perawat')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-2">Daftar Perawat Terdaftar</h1>
    <p class="text-on-surface-variant font-body-md text-base">Kelola verifikasi profil, status keanggotaan, dan hapus akun perawat.</p>
</div>

<!-- Search & Filter -->
<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 mb-6">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1 min-w-[250px]">
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="search">Cari Perawat</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">search</span>
                </div>
                <input type="text" id="search" name="search" class="block w-full pl-10 pr-3 py-2.5 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface placeholder-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-sm" placeholder="Cari nama atau email..." value="{{ request('search') }}">
            </div>
        </div>

        <div class="min-w-[180px]">
            <label class="block font-label-md text-sm font-medium text-on-surface mb-1" for="status">Filter Status</label>
            <select name="status" id="status" class="block w-full py-2.5 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Tertunda</option>
                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[18px]">search</span> Cari
            </button>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 bg-surface-container text-on-surface px-5 py-2.5 rounded-lg font-label-md text-sm hover:bg-surface-container-high transition-colors border border-outline-variant/20">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-sm font-label-md uppercase tracking-wider">
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Nama Lengkap</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Email</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium hidden md:table-cell">No. Telp</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium hidden lg:table-cell">Profil</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium">Status</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium hidden lg:table-cell">Tgl Daftar</th>
                    <th class="px-6 py-4 border-b border-outline-variant/30 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                @forelse($users as $user)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-on-surface">{{ $user->profile->full_name ?? '-' }}</td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm hidden md:table-cell">{{ $user->profile->phone ?? '-' }}</td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            @if($user->isProfileComplete())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Lengkap
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span> Belum
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->status === 'verified')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Terverifikasi
                                </span>
                            @elseif($user->status === 'rejected')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span> Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-label-md font-medium bg-tertiary-container text-on-tertiary-container">
                                    <span class="material-symbols-outlined text-[14px]">schedule</span> Tertunda
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-on-surface-variant text-sm hidden lg:table-cell">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center justify-center p-2 rounded-lg bg-surface-container text-on-surface hover:bg-surface-container-high transition-colors" title="Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                @if($user->status === 'pending' && $user->isProfileComplete())
                                    <form action="{{ route('admin.users.verify', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm" title="Setujui" onclick="return confirm('Setujui user ini?')">
                                            <span class="material-symbols-outlined text-[20px]">check</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg bg-error-container text-on-error-container hover:bg-error hover:text-on-error transition-colors" title="Tolak" onclick="return confirm('Tolak user ini?')">
                                            <span class="material-symbols-outlined text-[20px]">close</span>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus perawat ini beserta semua data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg text-error hover:bg-error-container transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-[48px] text-outline">group_off</span>
                                <p class="font-body-md text-sm">Tidak ditemukan data perawat.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection
