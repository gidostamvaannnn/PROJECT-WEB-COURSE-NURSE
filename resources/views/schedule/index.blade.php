@extends('layouts.app')

@section('title', 'Jadwal & Streak Belajar')

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
Jadwal & Streak
@endsection

@section('content')
<div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-carbon-black mb-2">Kalender Belajar Perawat (90 Hari)</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Target konsistensi 90 hari aktif belajar untuk menerbitkan sertifikat kompetensi resmi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Streak statistics overview card (1 col) -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2 pb-4 mb-6 border-b border-outline-variant">
                <span class="material-symbols-outlined text-amber-500 text-[24px]">local_fire_department</span>
                <h2 class="font-headline-md text-headline-md text-on-surface">Status Streak</h2>
            </div>

            <div class="text-center my-6">
                <div class="text-6xl font-headline-lg font-bold text-primary leading-none mb-2">{{ $currentStreak }}</div>
                <div class="text-sm font-label-md text-on-surface-variant">Hari Streak Saat Ini</div>
            </div>

            <div class="border-t border-outline-variant/30 pt-4 space-y-3 font-body-md text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Total Hari Aktif Belajar:</span>
                    <strong class="text-primary font-bold">{{ $activeDays }}/90 Hari</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Total Hari Tidak Belajar:</span>
                    <strong class="text-error font-bold">{{ $missedDays }} Hari</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Rekor Terlama Streak:</span>
                    <strong class="text-on-surface font-bold">{{ $longestStreak }} Hari</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Hari Berjalan Program:</span>
                    <strong class="text-on-surface font-bold">{{ $daysPassed }} Hari</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-on-surface-variant">Hari Tersisa Program:</span>
                    <strong class="text-primary font-bold">{{ $daysRemaining }} Hari</strong>
                </div>
            </div>

            <div class="space-y-1.5 mt-6">
                <div class="w-full bg-surface-container rounded-full h-3 overflow-hidden">
                    <div class="bg-primary h-3 rounded-full" style="width: {{ ($activeDays / 90) * 100 }}%"></div>
                </div>
            </div>
        </div>

        <div class="mt-6 p-4 rounded-xl bg-surface-container-low/60 border border-outline-variant/20 text-xs font-body-md text-on-surface-variant flex items-start gap-2">
            <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">info</span>
            <p><strong>Sistem Streak 90 Hari:</strong> Hari di mana Anda tidak mengakses platform atau tidak menonton video/kuisioner ditandai sebagai hari tidak belajar. Program Anda tetap lanjut dan tidak terputus, melainkan akumulasi hari aktif Anda tidak bertambah.</p>
        </div>
    </div>

    <!-- Calendar view card (2 cols) -->
    <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 mb-6 border-b border-outline-variant">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[24px]">calendar_month</span>
                <h2 class="font-headline-md text-headline-md text-on-surface">Pemetaan Kalender Belajar 3 Bulan</h2>
            </div>
            <div class="flex flex-wrap gap-2 text-xs font-label-md">
                <span class="px-2.5 py-1 rounded-full bg-secondary text-on-secondary font-bold">Aktif</span>
                <span class="px-2.5 py-1 rounded-full bg-error-container text-on-error-container font-medium">Absen</span>
                <span class="px-2.5 py-1 rounded-full bg-primary text-white font-bold ring-2 ring-secondary">Hari Ini</span>
                <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant font-medium">Mendatang</span>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-2 text-center font-label-md text-xs text-on-surface-variant font-bold mb-3">
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div>Sab</div>
            <div>Min</div>
        </div>

        <div class="grid grid-cols-7 gap-2">
            @php
                $firstDayOfWeek = $startDate->dayOfWeek;
                $offset = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;
            @endphp
            
            @for($o = 0; $o < $offset; $o++)
                <div class="aspect-square"></div>
            @endfor

            @foreach($calendarData as $dayData)
                @php
                    $statusCss = 'bg-surface-container-low text-outline/60';
                    if ($dayData['status'] === 'active') {
                        $statusCss = 'bg-neon-mint text-carbon-black font-bold shadow-sm';
                    } elseif ($dayData['status'] === 'missed') {
                        $statusCss = 'bg-error-container text-clinical-danger font-bold';
                    } elseif ($dayData['status'] === 'today') {
                        $statusCss = 'bg-primary-fixed text-royal-purple font-bold ring-2 ring-royal-purple shadow-sm';
                    }
                @endphp
                <div class="aspect-square rounded-xl flex flex-col items-center justify-center text-xs p-1 transition-all {{ $statusCss }}" title="Hari ke-{{ $dayData['day'] }} ({{ $dayData['date']->format('d/m/Y') }})">
                    <span class="font-bold text-sm">{{ $dayData['date']->format('d') }}</span>
                    <span class="text-[9px] opacity-80 mt-0.5">H-{{ $dayData['day'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
