@extends('layouts.admin')
@section('title','Kelola Jurusan')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;">🏫 Data & Status Jurusan</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-08 · Tambah dan kelola status jurusan</p>
    </div>
    <a href="{{ route('admin.jurusan.create') }}" style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;text-decoration:none;">＋ Tambah Jurusan</a>
</div>

@if(session('success'))
<div style="background:#ecfdf5;border:1px solid #a7f3d0;border-left:3px solid #059669;color:#065f46;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;">✅ {{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px;">
    @forelse($jurusans as $j)
    <div style="background:#fff;border:1px solid {{ $j->is_active ? '#e2e8f0' : '#fecaca' }};border-radius:14px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,.06);position:relative;overflow:hidden;">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $j->is_active ? '#059669' : '#dc2626' }};"></div>
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;">
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:15px;font-weight:800;color:#0d1117;margin-bottom:6px;">{{ $j->nama_jurusan}}</div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                    <span style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:2px 8px;border-radius:100px;font-size:10px;font-weight:700;">{{ $j->artikel_jurusan_count ?? 0 }} artikel</span>
                    <span style="background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe;padding:2px 8px;border-radius:100px;font-size:10px;font-weight:700;">{{ $j->prospek_kerja_count ?? 0 }} prospek</span>
                </div>
            </div>
            @if($j->is_active)
                <span style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;flex-shrink:0;">✅ Aktif</span>
            @else
                <span style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;flex-shrink:0;">❌ Nonaktif</span>
            @endif
        </div>
        <div style="display:flex;gap:8px;margin-top:16px;padding-top:14px;border-top:1px solid #e2e8f0;">
            <a href="{{ route('admin.jurusan.edit', $j->id) }}" style="flex:1;text-align:center;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:6px;border-radius:7px;font-size:11.5px;font-weight:700;text-decoration:none;">✏️ Edit</a>
            <form method="POST" action="{{ route('admin.jurusan.status', $j->id) }}" style="flex:1;">
                @csrf @method('PATCH')
                <button type="submit" style="width:100%;background:{{ $j->is_active ? '#fef2f2' : '#ecfdf5' }};color:{{ $j->is_active ? '#dc2626' : '#059669' }};border:1px solid {{ $j->is_active ? '#fecaca' : '#a7f3d0' }};padding:6px;border-radius:7px;font-size:11.5px;font-weight:700;cursor:pointer;">
                    {{ $j->is_active ? '🔴 Nonaktifkan' : '🟢 Aktifkan' }}
                </button>
            </form>
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:40px;color:#94a3b8;font-size:13px;">Belum ada data jurusan.</div>
    @endforelse
</div>
@endsection

