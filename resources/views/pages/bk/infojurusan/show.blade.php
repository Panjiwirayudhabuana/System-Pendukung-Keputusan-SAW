@extends('layouts.bk')
@section('title',"Info · {$jurusan->nama_jurusan}")
@section('page-title','Info Jurusan')
@section('page-sub','FR-BK-08/09 · Informasi jurusan yang kamu kelola')

@section('content')

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:3px solid #22c55e;border-radius:9px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#15803d;">
    ✅ {{ session('success') }}
</div>
@endif

{{-- HEADER JURUSAN --}}
<div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));border-radius:14px;padding:20px 24px;margin-bottom:20px;display:flex;align-items:center;gap:16px;">
    <div style="width:52px;height:52px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">🏫</div>
    <div style="flex:1;">
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.6);margin-bottom:4px;">Jurusan yang Kamu Kelola</div>
        <div style="font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:#fff;">{{ $jurusan->nama_jurusan }}</div>
    </div>
    <a href="{{ route('bk.infojurusan.edit', $jurusan->id) }}"
        style="background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.3);border-radius:9px;padding:9px 18px;font-size:12.5px;font-weight:700;text-decoration:none;white-space:nowrap;transition:background .2s;"
        onmouseover="this.style.background='rgba(255,255,255,.25)'"
        onmouseout="this.style.background='rgba(255,255,255,.15)'">
        ✏️ Edit Info
    </a>
</div>

{{-- FASILITAS --}}
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
        <span style="font-size:18px;">🏗️</span>
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Fasilitas Jurusan</div>
    </div>
    @if($info && $info->fasilitas)
        <p style="font-size:13px;color:#374151;line-height:1.7;white-space:pre-line;">{{ $info->fasilitas }}</p>
    @else
        <div style="font-size:13px;color:#94a3b8;font-style:italic;">Belum ada informasi fasilitas. <a href="{{ route('bk.infojurusan.edit', $jurusan->id) }}" style="color:#2563eb;">Tambahkan sekarang →</a></div>
    @endif
</div>

{{-- PROSPEK KERJA UMUM --}}
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
        <span style="font-size:18px;">💼</span>
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Prospek Kerja Umum</div>
    </div>
    @if($prospekUmum->count())
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @foreach($prospekUmum as $p)
                <span style="background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;border-radius:100px;padding:5px 14px;font-size:12.5px;font-weight:600;">
                    {{ $p->isi }}
                </span>
            @endforeach
        </div>
    @else
        <div style="font-size:13px;color:#94a3b8;font-style:italic;">Belum ada data prospek kerja umum.</div>
    @endif
</div>

{{-- PROSPEK KERJA ALUMNI --}}
<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
        <span style="font-size:18px;">🎓</span>
        <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Prospek Kerja Alumni</div>
    </div>
    @if($prospekAlumni->count())
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @foreach($prospekAlumni as $p)
                <span style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;border-radius:100px;padding:5px 14px;font-size:12.5px;font-weight:600;">
                    {{ $p->isi }}
                </span>
            @endforeach
        </div>
    @else
        <div style="font-size:13px;color:#94a3b8;font-style:italic;">Belum ada data prospek kerja alumni.</div>
    @endif
</div>

@endsection