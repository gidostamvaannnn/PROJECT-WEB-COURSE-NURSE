@extends('layouts.app')

@section('title', 'My Learning - NursePulse Academy')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 max-w-[1440px] mx-auto space-y-8">

    <!-- ======================================================== -->
    <!-- 1. Hero & 90-Day Master Banner (Stitch Design) -->
    <!-- ======================================================== -->
    <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-carbon-black via-[#1a1738] to-carbon-black text-surface-card-white shadow-xl">
        <div class="absolute -right-16 -top-24 w-96 h-96 bg-royal-purple/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -bottom-20 w-80 h-80 bg-neon-mint/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative p-6 sm:p-8 lg:p-10 flex flex-col xl:flex-row items-start xl:items-center justify-between gap-8">
            <div class="flex-1 space-y-4 max-w-3xl">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-neon-mint text-carbon-black font-label-caps text-label-caps tracking-wider uppercase shadow-sm font-bold">
                        <span class="material-symbols-outlined text-sm font-bold" style="font-variation-settings: 'FILL' 1;">verified</span>
                        NursePulse Member
                    </span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-card-white/10 text-surface-bright font-label-caps text-label-caps backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-neon-mint"></span>
                        Target Kelulusan: 90 Hari Aktif Belajar
                    </span>
                    @if($isTodayActive)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-neon-mint/20 text-neon-mint border border-neon-mint/30 font-label-caps text-label-caps font-bold">
                            <span class="material-symbols-outlined text-xs">check_circle</span>
                            Hari Ini Sudah Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 font-label-caps text-label-caps font-medium">
                            <span class="material-symbols-outlined text-xs">pending</span>
                            Belum Ada Aktivitas Hari Ini
                        </span>
                    @endif
                </div>

                <div class="space-y-1">
                    <h1 class="font-headline-lg text-headline-lg sm:text-[34px] tracking-tight text-surface-card-white font-extrabold">
                        Selamat Datang Kembali, {{ auth()->user()->profile->full_name ?? auth()->user()->name }}
                    </h1>
                    <p class="font-body-md text-body-md text-surface-variant font-medium">
                        {{ auth()->user()->profile?->hospital ?? 'Pelatihan Klinis Keperawatan Mandiri' }} • Kurikulum Pembelajaran Berkelanjutan Berstandar Nasional
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-label-md transition-all duration-200 shadow-lg shadow-royal-purple/30 font-bold" href="#modul-pembelajaran">
                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                        Lanjutkan Pembelajaran
                    </a>

                    @if($canGetCertificate)
                        <form action="{{ route('certificate.generate') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-neon-mint hover:bg-secondary-fixed text-carbon-black font-label-md text-label-md font-bold shadow-lg shadow-neon-mint/30 transition-all duration-200">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                                Klaim Sertifikat Kelulusan (90 Hari)
                            </button>
                        </form>
                    @elseif($hasCertificate)
                        <a class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-surface-card-white/15 hover:bg-surface-card-white/25 text-surface-card-white font-label-md text-label-md backdrop-blur-sm transition-all duration-200 font-bold" href="{{ route('certificate.show', auth()->user()->certificates->first()->id) }}">
                            <span class="material-symbols-outlined text-[18px]">download</span>
                            Lihat Sertifikat Resmi
                        </a>
                    @else
                        <a class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-surface-card-white/10 hover:bg-surface-card-white/20 text-surface-card-white font-label-md text-label-md backdrop-blur-sm transition-all duration-200" href="{{ route('schedule.index') }}">
                            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                            Jadwal &amp; Streak Belajar
                        </a>
                    @endif
                </div>
            </div>

            <!-- Gauge & 90 Days Progress Card (Right of Hero) -->
            <div class="w-full xl:w-96 p-5 rounded-xl bg-surface-card-white/5 backdrop-blur-md shadow-inner space-y-4 border border-surface-card-white/10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-ce-credit-gold text-[22px]">workspace_premium</span>
                        <span class="font-title-md text-title-md font-bold text-surface-card-white">Target 90 Hari Belajar</span>
                    </div>
                    <span class="font-metric-digit text-metric-digit text-neon-mint leading-none font-black">{{ min(100, round(($activeDays / 90) * 100)) }}%</span>
                </div>
                <div class="space-y-1.5">
                    <div class="flex justify-between font-label-caps text-label-caps text-surface-variant">
                        <span>Akumulasi Kehadiran</span>
                        <span class="text-surface-card-white font-bold">{{ $activeDays }} / 90 Hari Aktif</span>
                    </div>
                    <div class="w-full h-3 rounded-full bg-surface-card-white/10 overflow-hidden p-0.5">
                        <div class="h-full bg-gradient-to-r from-royal-purple via-secondary to-neon-mint rounded-full transition-all duration-500" style="width: {{ min(100, round(($activeDays / 90) * 100)) }}%"></div>
                    </div>
                </div>
                <div class="pt-2 flex items-center justify-between font-body-sm text-body-sm text-surface-variant">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-neon-mint">local_fire_department</span>
                        Streak: <strong class="text-surface-card-white font-bold">{{ $currentStreak }} Hari</strong>
                    </span>
                    <span class="text-neon-mint font-semibold">Sisa {{ max(0, 90 - $activeDays) }} Hari Target</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 2. Quick Stat Strip (4 Real Metric Cards) -->
    <!-- ======================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Modul Pembelajaran -->
        <div class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-royal-purple shrink-0">
                <span class="material-symbols-outlined text-[26px]">school</span>
            </div>
            <div>
                <div class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">{{ $completedCourses }} / {{ $totalCourses }}</div>
                <div class="font-body-sm text-xs text-on-surface-variant">Modul Video Tuntas</div>
            </div>
        </div>

        <!-- Card 2: Video Selesai Ditonton -->
        <div class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
            <div class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-secondary shrink-0">
                <span class="material-symbols-outlined text-[26px]">play_circle</span>
            </div>
            <div>
                <div class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">{{ $totalVideosCompleted }}</div>
                <div class="font-body-sm text-xs text-on-surface-variant">Video Telah Diselesaikan</div>
            </div>
        </div>

        <!-- Card 3: Kuisioner / Evaluasi Lulus -->
        <div class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
            <div class="w-12 h-12 rounded-xl bg-neon-mint/30 flex items-center justify-center text-secondary shrink-0">
                <span class="material-symbols-outlined text-[26px]">quiz</span>
            </div>
            <div>
                <div class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">{{ $totalQuestionnairesCompleted }} / {{ $totalQuestionnaires }}</div>
                <div class="font-body-sm text-xs text-on-surface-variant">Kuisioner Evaluasi Lulus</div>
            </div>
        </div>

        <!-- Card 4: Hari Aktif & Streak -->
        <div class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
            <div class="w-12 h-12 rounded-xl bg-error-container flex items-center justify-center text-clinical-danger shrink-0">
                <span class="material-symbols-outlined text-[26px]">local_fire_department</span>
            </div>
            <div>
                <div class="flex items-center gap-1.5">
                    <span class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">{{ $activeDays }} / 90</span>
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-label-caps font-bold bg-neon-mint text-carbon-black">HARI</span>
                </div>
                <div class="font-body-sm text-xs text-on-surface-variant">Hari Aktif (Streak: {{ $currentStreak }} Hari)</div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- 3. Modul Pembelajaran Klinis (Real Courses from Database) -->
    <!-- ======================================================== -->
    <section class="space-y-4" id="modul-pembelajaran">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="font-headline-md text-headline-md font-bold text-carbon-black">Modul Pembelajaran Klinis</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Tonton seluruh materi video hingga 100% tuntas untuk membuka kuisioner evaluasi pemahaman klinis Anda.
                </p>
            </div>
            <a class="font-label-md text-label-md text-royal-purple hover:text-primary font-bold flex items-center gap-1 w-fit" href="{{ route('courses.index') }}">
                Lihat Semua Modul
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6">
            @forelse($courses as $course)
                @php
                    $courseProgress = $course->progress ?? $course->getUserProgressPercentage(auth()->id());
                    $isAllCompleted = $course->all_completed ?? $course->allVideosCompleted(auth()->id());
                    $firstQuestionnaire = $course->questionnaires->first();
                    $attempt = $firstQuestionnaire ? $firstQuestionnaire->userAttempt(auth()->id()) : null;
                @endphp
                <div class="group flex flex-col justify-between rounded-xl bg-surface-card-white shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-soft-gray/70">
                    <div>
                        <!-- Card Header & Thumbnail -->
                        <div class="relative h-40 w-full overflow-hidden bg-gradient-to-tr from-carbon-black via-[#1a1738] to-carbon-black flex items-center justify-center">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $course->title }}" src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('cover course/cover.jpg') }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-carbon-black/80 via-transparent to-transparent"></div>
                            
                            <!-- Video Count Badge -->
                            <div class="absolute top-3 right-3 bg-carbon-black/80 backdrop-blur-md px-2.5 py-1 rounded-full text-xs font-label-caps text-surface-card-white flex items-center gap-1 font-semibold">
                                <span class="material-symbols-outlined text-neon-mint text-[14px]">subscriptions</span>
                                <span>{{ $course->video_count }} Video</span>
                            </div>

                            <!-- Prerequisite / Quiz Status Badge on image -->
                            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-surface-card-white font-label-caps text-label-caps">
                                @if($attempt && $attempt->is_passed)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-neon-mint text-carbon-black font-bold">
                                        <span class="material-symbols-outlined text-[12px]">check_circle</span>
                                        Lulus Kuis ({{ $attempt->score }})
                                    </span>
                                @elseif($isAllCompleted)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-royal-purple text-surface-card-white font-bold">
                                        <span class="material-symbols-outlined text-[12px]">lock_open</span>
                                        Kuisioner Terbuka
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-carbon-black/70 text-surface-variant font-medium">
                                        <span class="material-symbols-outlined text-[12px]">lock</span>
                                        Kuis Terkunci
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <div class="space-y-1">
                                <span class="font-label-caps text-[10px] text-royal-purple uppercase tracking-wider font-bold">MODUL #{{ $course->order_number ?? $loop->iteration }}</span>
                                <h3 class="font-headline-sm text-base font-bold text-carbon-black group-hover:text-royal-purple transition-colors line-clamp-2">
                                    {{ $course->title }}
                                </h3>
                            </div>
                            <p class="font-body-sm text-xs text-on-surface-variant line-clamp-2">
                                {{ $course->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer & Actions -->
                    <div class="p-5 pt-0 space-y-3">
                        <div class="space-y-1">
                            <div class="flex justify-between font-label-caps text-xs text-on-surface-variant">
                                <span>Progress Video</span>
                                <span class="font-bold text-carbon-black">{{ $courseProgress }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-soft-gray overflow-hidden">
                                <div class="h-full bg-neon-mint rounded-full transition-all duration-500" style="width: {{ $courseProgress }}%"></div>
                            </div>
                        </div>

                        <a class="w-full py-2.5 px-4 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-xs flex items-center justify-center gap-2 transition-colors font-bold shadow-sm" href="{{ route('courses.show', $course) }}">
                            @if($isAllCompleted)
                                <span>Buka Modul &amp; Evaluasi</span>
                                <span class="material-symbols-outlined text-sm">assignment</span>
                            @else
                                <span>Lanjutkan Belajar</span>
                                <span class="material-symbols-outlined text-sm">play_arrow</span>
                            @endif
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-surface-card-white rounded-xl border border-soft-gray">
                    <span class="material-symbols-outlined text-[48px] text-outline mb-2">menu_book</span>
                    <p class="text-on-surface-variant font-medium">Belum ada modul aktif saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 4. Kalender 90 Hari Aktif Belajar (Pilar Utama Program) -->
    <!-- ======================================================== -->
    <section class="rounded-xl bg-surface-card-white p-6 shadow-sm space-y-6 border border-soft-gray/70">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-soft-gray">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-royal-purple text-[26px]">calendar_month</span>
                    <h2 class="font-headline-md text-xl font-bold text-carbon-black">Kalender 90 Hari Aktif Belajar</h2>
                </div>
                <p class="font-body-sm text-sm text-on-surface-variant max-w-2xl">
                    Sistem mengakumulasi setiap hari aktif belajar Anda (menonton video materi atau mengerjakan kuis). Hari absen tidak menggagalkan program, namun hanya hari aktif yang dihitung menuju kelulusan 90 hari.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-container-low text-carbon-black font-label-caps text-xs font-bold border border-soft-gray">
                    <span class="w-2.5 h-2.5 rounded-full bg-neon-mint"></span>
                    {{ $activeDays }} / 90 Hari Aktif
                </span>
                <a href="{{ route('schedule.index') }}" class="inline-flex items-center gap-1 text-royal-purple hover:text-primary font-label-md text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-surface-container transition-colors">
                    <span>Lihat Jadwal Lengkap</span>
                    <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Eligibility / Certificate Banner if ready -->
        @if($canGetCertificate)
            <div class="p-5 rounded-xl bg-neon-mint/20 border-2 border-neon-mint flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-secondary text-[36px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <div>
                        <h4 class="font-headline-sm text-base font-bold text-carbon-black">Selamat! Syarat 90 Hari Aktif Belajar Terpenuhi!</h4>
                        <p class="text-xs text-on-surface-variant">Anda telah menyelesaikan akumulasi 90 hari aktif belajar. Klik tombol di samping untuk menerbitkan sertifikat kelulusan resmi Anda.</p>
                    </div>
                </div>
                <form action="{{ route('certificate.generate') }}" method="POST" class="shrink-0 w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-carbon-black text-surface-card-white text-xs font-bold hover:bg-carbon-black/80 transition-colors shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">workspace_premium</span>
                        Klaim Sertifikat Kelulusan
                    </button>
                </form>
            </div>
        @elseif($hasCertificate)
            <div class="p-4 rounded-xl bg-surface-container-low border border-soft-gray flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-royal-purple text-[32px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <div>
                        <h4 class="font-label-md text-sm font-bold text-carbon-black">Sertifikat Resmi Telah Terbit</h4>
                        <p class="text-xs text-on-surface-variant">Anda telah mengantongi sertifikat kelulusan program NursePulse Academy.</p>
                    </div>
                </div>
                <a href="{{ route('certificate.show', auth()->user()->certificates->first()->id) }}" class="px-4 py-2 rounded-lg bg-royal-purple text-surface-card-white text-xs font-bold hover:bg-primary transition-colors flex items-center justify-center gap-1.5 shrink-0">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                    Lihat Sertifikat
                </a>
            </div>
        @endif

        <!-- 90 Days Grid -->
        <div>
            <div class="grid grid-cols-10 sm:grid-cols-15 md:grid-cols-18 gap-1.5 sm:gap-2">
                @for($i = 1; $i <= 90; $i++)
                    @php
                        $dayDate = $startDate->copy()->addDays($i - 1);
                        $dateKey = $dayDate->format('Y-m-d');
                        $isActive = in_array($dateKey, $dailyProgressRecords);
                        $isToday = $dayDate->isToday();
                        $isPast = $dayDate->isPast() && !$isToday;
                    @endphp
                    <div class="aspect-square rounded-lg flex flex-col items-center justify-center text-xs font-semibold transition-all duration-150 relative group cursor-pointer
                        {{ $isActive ? 'bg-neon-mint text-carbon-black font-bold shadow-sm' : '' }}
                        {{ $isToday && !$isActive ? 'ring-2 ring-royal-purple bg-primary-fixed text-royal-purple font-bold' : '' }}
                        {{ $isToday && $isActive ? 'ring-2 ring-carbon-black' : '' }}
                        {{ !$isActive && !$isToday && $isPast ? 'bg-surface-container-high/60 text-outline/80' : '' }}
                        {{ !$isActive && !$isToday && !$isPast ? 'bg-surface-container-low text-outline/50' : '' }}
                    " title="Hari ke-{{ $i }} ({{ $dayDate->format('d/m/Y') }}): {{ $isActive ? 'Aktif Belajar' : ($isToday ? 'Hari Ini (Belum Ada Aktivitas)' : ($isPast ? 'Tidak Ada Aktivitas' : 'Mendatang')) }}">
                        <span class="text-[11px] sm:text-xs leading-none">{{ $i }}</span>
                        @if($isActive)
                            <span class="material-symbols-outlined text-[10px] leading-none text-carbon-black mt-0.5">check</span>
                        @endif
                    </div>
                @endfor
            </div>

            <!-- Legend -->
            <div class="mt-4 pt-4 border-t border-soft-gray flex flex-wrap items-center justify-between gap-4 text-xs font-body-sm text-on-surface-variant">
                <div class="flex items-center gap-4 flex-wrap">
                    <span class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-neon-mint inline-block"></span>
                        <span class="font-medium text-carbon-black">Hari Aktif Belajar ({{ $activeDays }})</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded ring-2 ring-royal-purple bg-primary-fixed inline-block"></span>
                        <span class="font-medium text-carbon-black">Hari Ini</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-surface-container-high/60 inline-block"></span>
                        <span>Tidak Belajar (Absen)</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-surface-container-low border border-soft-gray inline-block"></span>
                        <span>Hari Mendatang</span>
                    </span>
                </div>
                <div class="text-xs text-outline font-medium">
                    Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 5. Panduan Alur Belajar & Syarat Kelulusan (Konsep Course) -->
    <!-- ======================================================== -->
    <section class="space-y-4">
        <div class="space-y-1">
            <h2 class="font-headline-md text-headline-md font-bold text-carbon-black">Panduan Alur Program Belajar</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
                Empat pilar utama penyelesaian program pelatihan NursePulse Academy hingga penerbitan sertifikat kelulusan resmi.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Pillar 1 -->
            <div class="p-5 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-royal-purple font-bold text-sm">
                    01
                </div>
                <div class="space-y-1">
                    <h4 class="font-title-md text-sm font-bold text-carbon-black flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-royal-purple text-base">video_library</span>
                        Tonton Video 100%
                    </h4>
                    <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                        Tonton setiap video pembelajaran pada modul hingga selesai. Seluruh video wajib tuntas sebagai prasyarat membuka kuisioner.
                    </p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="p-5 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-lg bg-secondary-fixed flex items-center justify-center text-secondary font-bold text-sm">
                    02
                </div>
                <div class="space-y-1">
                    <h4 class="font-title-md text-sm font-bold text-carbon-black flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-secondary text-base">quiz</span>
                        Evaluasi &amp; Kuis
                    </h4>
                    <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                        Kerjakan kuisioner evaluasi pemahaman materi modul. Raih nilai di atas batas kelulusan (passing score) untuk menuntaskan modul.
                    </p>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="p-5 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-lg bg-neon-mint/30 flex items-center justify-center text-secondary font-bold text-sm">
                    03
                </div>
                <div class="space-y-1">
                    <h4 class="font-title-md text-sm font-bold text-carbon-black flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-secondary text-base">calendar_month</span>
                        Akumulasi 90 Hari
                    </h4>
                    <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                        Lakukan aktivitas belajar minimal 90 hari secara akumulatif. Absen tidak mereset hari yang telah terkumpul sebelumnya.
                    </p>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="p-5 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-lg bg-error-container flex items-center justify-center text-clinical-danger font-bold text-sm">
                    04
                </div>
                <div class="space-y-1">
                    <h4 class="font-title-md text-sm font-bold text-carbon-black flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-clinical-danger text-base">workspace_premium</span>
                        Sertifikat Otomatis
                    </h4>
                    <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                        Tombol klaim sertifikat otomatis aktif begitu target 90 hari aktif belajar terpenuhi. Sertifikat dapat diunduh kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
