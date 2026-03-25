@extends('layouts.bk')
@section('title','Info Jurusan')
@section('page-title','Info Jurusan')
@section('page-sub','FR-BK-08/09 · Kelola fasilitas & prospek kerja')

@section('content')
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
    @foreach($jurusans as $j)
    <div class="card" style="padding:18px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:9px;background:var(--blue-bg);display:flex;align-items:center;justify-content:center;font-size:20px;">🏫</div>
            <div>
                <div style="font-size:13px;font-weight:800;color:var(--primary-dark);">{{ $j->nama }}</div>
                <div style="font-size:11px;color:var(--text-dim);">
                    {{ $j->informasiJurusan ? 'Info tersedia' : 'Belum ada info' }}
                    · {{ $j->prospekKerja->count() }} prospek
                </div>
            </div>
        </div>
        @if($j->informasiJurusan?->fasilitas)
            <div style="font-size:12px;color:var(--text-mid);line-height:1.6;margin-bottom:10px;">{{ Str::limit($j->informasiJurusan->fasilitas, 80) }}</div>
        @else
            <div style="font-size:12px;color:var(--text-dim);font-style:italic;margin-bottom:10px;">Fasilitas & prospek belum diisi.</div>
        @endif
        <a href="{{ route('bk.infojurusan.edit', $j->id) }}" class="btn btn-outline btn-sm">✏️ Edit Info</a>
    </div>
    @endforeach
</div>
@endsection