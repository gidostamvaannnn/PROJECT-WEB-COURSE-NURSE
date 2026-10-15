@extends('layouts.app')

@section('title', 'Sertifikat Kelulusan')

@section('breadcrumb')
<a href="{{ route('dashboard') }}" class="text-primary hover:underline">Dashboard</a>
<span class="text-outline">/</span>
Sertifikat Kelulusan
@endsection

@section('styles')
<style>
    .certificate-wrapper {
        max-width: 860px;
        margin: 20px auto;
        padding: 16px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 12px 36px rgba(24, 16, 43, 0.08);
        border: 4px double #834DFB;
        position: relative;
    }
    .certificate-inner {
        border: 2px solid #F0E100;
        padding: 48px 36px;
        border-radius: 10px;
        text-align: center;
        background: radial-gradient(circle at center, #ffffff 60%, #F5F3FF 100%);
        position: relative;
    }
    .certificate-title {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 4px;
        color: #834DFB;
        margin-bottom: 8px;
    }
    .certificate-heading {
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #18102B;
        margin-bottom: 28px;
    }
    .certificate-name {
        font-size: 32px;
        font-weight: 800;
        color: #18102B;
        padding: 12px 24px;
        margin: 20px auto;
        display: inline-block;
        border-bottom: 3px solid #834DFB;
    }
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            background: #ffffff !important;
        }
        .certificate-wrapper {
            box-shadow: none;
            border: 2px solid #834DFB;
            margin: 0;
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="mb-6 no-print text-center">
    <h1 class="text-2xl md:text-3xl font-headline-md font-bold text-on-surface mb-2">Sertifikat Kompetensi Perawat</h1>
    <p class="text-on-surface-variant font-body-md text-sm">Unduh atau cetak dokumen kelulusan program belajar Anda di sini.</p>
</div>

<div class="no-print mb-8 flex justify-center gap-3">
    <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-xl font-label-md text-sm hover:bg-primary/90 transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[18px]">print</span> Cetak / Simpan PDF
    </button>
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-surface-container text-on-surface rounded-xl font-label-md text-sm hover:bg-surface-container-high transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Dashboard
    </a>
</div>

<div class="certificate-wrapper">
    <div class="certificate-inner">
        <div class="certificate-title">SERTIFIKAT KELULUSAN</div>
        <div class="certificate-heading">NURSEPULSE ACADEMY PLATFORM</div>
        
        <p class="text-on-surface-variant text-sm font-body-md">Sertifikat ini diberikan secara sah kepada perawat:</p>
        
        <div class="certificate-name">{{ $profile->full_name }}</div>
        
        <p class="text-on-surface-variant text-sm font-body-md max-w-xl mx-auto leading-relaxed mb-6">
            Atas dedikasi, konsistensi, dan komitmen belajar secara mandiri dalam menyelesaikan program pelatihan keperawatan intensif selama <strong class="text-primary font-bold">90 hari aktif belajar</strong> dengan hasil kelulusan yang memuaskan.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-10 text-sm border-t border-b border-outline-variant/30 py-6">
            <div>
                <div class="text-xs text-on-surface-variant mb-1">Nomor Sertifikat:</div>
                <div class="font-bold text-primary font-mono">{{ $certificate->certificate_number }}</div>
            </div>
            <div>
                <div class="text-xs text-on-surface-variant mb-1">Tanggal Penerbitan:</div>
                <div class="font-bold text-on-surface">{{ $certificate->issued_date->format('d F Y') }}</div>
            </div>
            <div>
                <div class="text-xs text-on-surface-variant mb-1">Modul Diselesaikan:</div>
                <div class="font-bold text-on-surface">{{ $certificate->total_courses_completed }} Modul / {{ $certificate->total_questionnaires_passed }} Evaluasi</div>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center">
            <div class="border-t-2 border-primary w-48 pt-2 font-bold text-xs uppercase tracking-wider text-on-surface">
                KOMITE NURSEPULSE ACADEMY
            </div>
            <div class="text-on-surface-variant text-[11px] mt-1">Platform Peningkatan Kompetensi Digital</div>
        </div>
    </div>
</div>
@endsection
