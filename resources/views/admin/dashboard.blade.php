@extends('layouts.admin')

@section('title', 'Overview Dashboard')

@section('content')
<!-- Greeting -->
<section>
    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Selamat Datang, Administrator</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Monitoring dan kelola sistem pembelajaran klinis perawat profesional NursePulse Academy.</p>
</section>

<!-- Statistical Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
    <!-- Card 1 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl clinical-shadow stat-card-glow border border-white">
        <div class="w-12 h-12 bg-surface-container flex items-center justify-center rounded-lg mb-4">
            <span class="material-symbols-outlined text-primary">groups</span>
        </div>
        <p class="font-label-md text-label-md text-on-surface-variant">Total Perawat Terdaftar</p>
        <h3 class="text-3xl font-bold text-primary mt-1">{{ $totalUsers }}</h3>
        <div class="flex items-center gap-1 mt-2 text-secondary">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span class="font-caption text-caption">Perawat aktif dalam sistem</span>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl clinical-shadow stat-card-glow border border-white">
        <div class="w-12 h-12 bg-error-container flex items-center justify-center rounded-lg mb-4">
            <span class="material-symbols-outlined text-error">assignment_late</span>
        </div>
        <p class="font-label-md text-label-md text-on-surface-variant">Verifikasi Tertunda</p>
        <h3 class="text-3xl font-bold text-error mt-1">{{ $pendingUsers }}</h3>
        <div class="flex items-center gap-1 mt-2 text-error">
            <span class="material-symbols-outlined text-sm">priority_high</span>
            <span class="font-caption text-caption">Butuh persetujuan admin</span>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl clinical-shadow stat-card-glow border border-white">
        <div class="w-12 h-12 bg-secondary-container flex items-center justify-center rounded-lg mb-4">
            <span class="material-symbols-outlined text-on-secondary-container">task_alt</span>
        </div>
        <p class="font-label-md text-label-md text-on-surface-variant">Perawat Terverifikasi</p>
        <h3 class="text-3xl font-bold text-on-secondary-container mt-1">{{ $verifiedUsers }}</h3>
        <div class="flex items-center gap-1 mt-2 text-secondary">
            <span class="material-symbols-outlined text-sm">verified</span>
            <span class="font-caption text-caption">Akses penuh pembelajaran</span>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl clinical-shadow stat-card-glow border border-white">
        <div class="w-12 h-12 bg-tertiary-fixed flex items-center justify-center rounded-lg mb-4">
            <span class="material-symbols-outlined text-tertiary">school</span>
        </div>
        <p class="font-label-md text-label-md text-on-surface-variant">Total Modul Course</p>
        <h3 class="text-3xl font-bold text-tertiary mt-1">{{ $totalCourses }}</h3>
        <div class="flex items-center gap-1 mt-2 text-tertiary">
            <span class="material-symbols-outlined text-sm">menu_book</span>
            <span class="font-caption text-caption">Kurikulum aktif</span>
        </div>
    </div>
</div>

<!-- Main Dashboard Layout: Bento Grid Style -->
<div class="grid grid-cols-12 gap-gutter">
    <!-- Table Section (8 Cols) -->
    <div class="col-span-12 lg:col-span-8 bg-surface-container-lowest rounded-xl clinical-shadow border border-white overflow-hidden">
        <div class="px-6 py-5 border-b border-outline-variant flex justify-between items-center">
            <h2 class="font-headline-md text-headline-md text-on-surface">Permintaan Verifikasi Terbaru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-primary font-label-md hover:underline flex items-center gap-1">
                <span>View All</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-surface-container-low text-on-surface-variant">
                    <tr>
                        <th class="px-6 py-4 font-label-md">Nama Perawat</th>
                        <th class="px-6 py-4 font-label-md">Tanggal Lahir</th>
                        <th class="px-6 py-4 font-label-md">Gender</th>
                        <th class="px-6 py-4 font-label-md">Status</th>
                        <th class="px-6 py-4 font-label-md">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse($recentUsers as $user)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-fixed text-primary flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($user->profile->full_name ?? $user->email, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-body-md font-medium">{{ $user->profile->full_name ?? 'Belum Lengkap' }}</div>
                                        <div class="text-xs text-on-surface-variant">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-body-md text-on-surface-variant">
                                {{ $user->profile->date_of_birth ? $user->profile->date_of_birth->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-body-md text-on-surface-variant">
                                {{ $user->profile->gender === 'male' ? 'Laki-laki' : ($user->profile->gender === 'female' ? 'Perempuan' : '-') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->status === 'verified')
                                    <span class="px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-md text-xs">Verified</span>
                                @elseif($user->status === 'rejected')
                                    <span class="px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-md text-xs">Rejected</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-label-md text-xs">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-primary hover:text-secondary-fixed-dim transition-colors inline-block" title="Detail">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-on-surface-variant">
                                Belum ada pendaftaran perawat baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Course Performance Section (4 Cols) -->
    <div class="col-span-12 lg:col-span-4 space-y-gutter">
        <div class="bg-surface-container-lowest p-6 rounded-xl clinical-shadow border border-white">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-6">Informasi Sistem</h2>
            <div class="space-y-6">
                <!-- ICU -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-label-md text-label-md text-on-surface">Persyaratan Video</span>
                        <span class="font-label-md text-label-md text-primary font-bold">100% Selesai</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3">
                        <div class="bg-primary h-3 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                <!-- NICU -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-label-md text-label-md text-on-surface">Mekanisme Kuisioner</span>
                        <span class="font-label-md text-label-md text-primary font-bold">Terunci</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3">
                        <div class="bg-secondary h-3 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <!-- Streak -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-label-md text-label-md text-on-surface">Komitmen Streak</span>
                        <span class="font-label-md text-label-md text-primary font-bold">3 Bulan</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-3">
                        <div class="bg-on-secondary-container h-3 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="mt-8 p-4 bg-surface-container-low rounded-lg">
                <p class="font-caption text-caption text-on-surface-variant">Catatan Admin</p>
                <p class="font-body-md text-body-md text-on-surface mt-1 italic">"Video pembelajaran harus ditonton hingga 100% untuk membuka lembar evaluasi kuisioner perawat."</p>
            </div>
        </div>

        <!-- Mini Report Activity -->
        <div class="bg-primary text-on-primary p-6 rounded-xl clinical-shadow">
            <h3 class="font-label-md text-label-md opacity-80">Target Sertifikasi</h3>
            <p class="font-headline-md text-headline-md mt-1">Standar SKP Kemenkes</p>
            <div class="mt-6 flex items-end gap-2">
                <div class="flex-1 bg-white/20 h-16 rounded-sm"></div>
                <div class="flex-1 bg-white/40 h-24 rounded-sm"></div>
                <div class="flex-1 bg-white/20 h-12 rounded-sm"></div>
                <div class="flex-1 bg-white/60 h-28 rounded-sm"></div>
                <div class="flex-1 bg-white/30 h-18 rounded-sm"></div>
                <div class="flex-1 bg-white h-32 rounded-sm"></div>
            </div>
            <p class="mt-4 font-caption text-caption opacity-80 text-center">NursePulse Academy Clinical Education</p>
        </div>
    </div>
</div>
@endsection
