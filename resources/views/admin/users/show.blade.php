@extends('layouts.admin')

@section('title', 'Detail Perawat')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-primary hover:underline font-label-md mb-2">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Daftar Perawat
        </a>
        <h1 class="text-3xl font-headline-md font-bold text-on-surface mb-1">Profil & Kemajuan Perawat</h1>
        <p class="text-on-surface-variant font-body-md text-sm">Detail pendaftaran, progress menonton video, serta pencapaian evaluasi.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- User Profile Card -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 flex flex-col h-fit">
        <div class="flex items-center gap-2 pb-4 mb-6 border-b border-outline-variant/30 text-on-surface font-headline-md font-bold">
            <span class="material-symbols-outlined text-primary text-[24px]">account_circle</span>
            <span>Data Profil Perawat</span>
        </div>

        <div class="flex flex-col items-center text-center mb-6">
            <div class="w-20 h-20 rounded-full bg-primary text-on-primary font-headline-md font-bold text-2xl flex items-center justify-center mb-4 shadow-sm">
                {{ strtoupper(substr($user->profile->full_name ?? $user->email, 0, 2)) }}
            </div>
            <h3 class="font-headline-md font-bold text-on-surface text-lg mb-1">{{ $user->profile->full_name ?? 'Belum Melengkapi Profil' }}</h3>
            <p class="text-sm text-on-surface-variant font-body-md mb-3">{{ $user->email }}</p>
            <div>
                @if($user->status === 'verified')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Terverifikasi
                    </span>
                @elseif($user->status === 'rejected')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                        <span class="material-symbols-outlined text-[14px]">cancel</span> Ditolak
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-label-md font-medium bg-tertiary-container text-on-tertiary-container">
                        <span class="material-symbols-outlined text-[14px]">schedule</span> Menunggu Verifikasi
                    </span>
                @endif
            </div>
        </div>

        <div class="border-t border-outline-variant/30 pt-4 space-y-4">
            <div>
                <span class="text-xs text-on-surface-variant block font-label-md">Tanggal Lahir</span>
                <strong class="text-sm font-body-md text-on-surface block mt-0.5">{{ $user->profile->date_of_birth ? $user->profile->date_of_birth->format('d F Y') : '-' }}</strong>
            </div>
            <div>
                <span class="text-xs text-on-surface-variant block font-label-md">Jenis Kelamin</span>
                <strong class="text-sm font-body-md text-on-surface block mt-0.5">{{ $user->profile->gender === 'male' ? 'Laki-laki' : ($user->profile->gender === 'female' ? 'Perempuan' : '-') }}</strong>
            </div>
            <div>
                <span class="text-xs text-on-surface-variant block font-label-md">No. Telp WhatsApp</span>
                <strong class="text-sm font-body-md text-on-surface block mt-0.5">{{ $user->profile->phone ?? '-' }}</strong>
            </div>
            <div>
                <span class="text-xs text-on-surface-variant block font-label-md">Tanggal Daftar</span>
                <strong class="text-sm font-body-md text-on-surface block mt-0.5">{{ $user->created_at->format('d/m/Y H:i') }}</strong>
            </div>
        </div>
        
        @if($user->status === 'pending' && $user->isProfileComplete())
            <div class="mt-6 pt-4 border-t border-outline-variant/30 flex gap-3">
                <form action="{{ route('admin.users.verify', $user) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 bg-primary text-on-primary py-2 px-4 rounded-lg font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">check</span> Setujui
                    </button>
                </form>
                <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-1.5 bg-error-container text-on-error-container py-2 px-4 rounded-lg font-label-md text-sm hover:bg-error hover:text-on-error transition-colors">
                        <span class="material-symbols-outlined text-[18px]">close</span> Tolak
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Video Progress & Quiz Achievements -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Video Progress Card -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6">
            <div class="flex items-center gap-2 pb-4 mb-4 border-b border-outline-variant/30 text-on-surface font-headline-md font-bold">
                <span class="material-symbols-outlined text-primary text-[24px]">play_circle</span>
                <span>Video Pembelajaran Yang Ditonton</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-xs font-label-md uppercase tracking-wider">
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Modul</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Judul Video</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Progress</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($user->videoProgress as $progress)
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-on-surface text-sm">{{ $progress->video->course->title }}</td>
                                <td class="px-4 py-3 text-on-surface-variant text-sm">{{ $progress->video->title }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-24 bg-surface-container-high rounded-full h-2 overflow-hidden">
                                            <div class="bg-primary h-full rounded-full" style="width: {{ $progress->percentage }}%"></div>
                                        </div>
                                        <span class="text-xs font-label-md text-on-surface-variant">{{ round($progress->percentage) }}%</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($progress->is_completed)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-label-md font-medium bg-tertiary-container text-on-tertiary-container">
                                            Menonton
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant text-sm">
                                    Belum ada progress menonton video.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quiz Attempts Card -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6">
            <div class="flex items-center gap-2 pb-4 mb-4 border-b border-outline-variant/30 text-on-surface font-headline-md font-bold">
                <span class="material-symbols-outlined text-primary text-[24px]">assignment_turned_in</span>
                <span>Percobaan Hasil Kuisioner</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-xs font-label-md uppercase tracking-wider">
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Judul Kuisioner</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Skor</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Status</th>
                            <th class="px-4 py-3 border-b border-outline-variant/30 font-medium">Tanggal Kirim</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($user->questionnaireAttempts as $attempt)
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-on-surface text-sm">{{ $attempt->questionnaire->title }}</td>
                                <td class="px-4 py-3 font-bold text-primary text-sm">{{ $attempt->score }}%</td>
                                <td class="px-4 py-3">
                                    @if($attempt->is_passed)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-label-md font-medium bg-secondary-container text-on-secondary-container">
                                            Lulus
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-label-md font-medium bg-error-container text-on-error-container">
                                            Gagal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant text-sm">{{ $attempt->submitted_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant text-sm">
                                    Belum ada lembar evaluasi kuisioner yang disubmit.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
