@extends('layouts.admin')
@section('title', isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan')
@section('content')
<div style="max-width:480px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.jurusan.index') }}" style="font-size:12px;color:#2563eb;text-decoration:none;">← Kembali</a>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;margin-top:8px;">
            {{ isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan' }}
        </h1>
    </div>
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <form method="POST" action="{{ isset($jurusan) ? route('admin.jurusan.update', $jurusan->id) : route('admin.jurusan.store') }}">
            @csrf
            @if(isset($jurusan)) @method('PUT') @endif

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Nama Jurusan *</label>
                <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan?? '') }}" placeholder="Contoh: Teknik Komputer dan Jaringan" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                @error('nama_jurusan')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Status *</label>
                <div style="display:flex;gap:12px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:10px 16px;border:1.5px solid #e2e8f0;border-radius:9px;flex:1;">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $jurusan->is_active ?? 1) == 1 ? 'checked' : '' }}>
                        <span style="font-size:13px;font-weight:600;">✅ Aktif</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:10px 16px;border:1.5px solid #e2e8f0;border-radius:9px;flex:1;">
                        <input type="radio" name="is_active" value="0" {{ old('is_active', $jurusan->is_active ?? 1) == 0 ? 'checked' : '' }}>
                        <span style="font-size:13px;font-weight:600;">❌ Nonaktif</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a href="{{ route('admin.jurusan.index') }}" style="padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;border:1.5px solid #e2e8f0;color:#64748b;text-decoration:none;">Batal</a>
                <button type="submit" style="padding:9px 22px;border-radius:9px;font-size:12.5px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;">✓ Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
