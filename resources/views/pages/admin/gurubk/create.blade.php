@extends('layouts.admin')
@section('title','Tambah Guru BK')
@section('content')
<div style="max-width:640px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.gurubk.index') }}" style="font-size:12px;color:#2563eb;text-decoration:none;">← Kembali</a>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;margin-top:8px;">Tambah Akun Guru BK</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-02 · Password default: <code style="background:#f1f5f9;padding:1px 6px;border-radius:4px;">password123</code> (Guru BK wajib ganti saat login pertama)</p>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <form method="POST" action="{{ route('admin.gurubk.store') }}">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Nama Lengkap <span style="color:#dc2626;">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso, S.Pd." style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;color:#0d1117;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                @error('nama')<div style="color:#dc2626;font-size:11.5px;margin-top:5px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Email <span style="color:#dc2626;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="gurubk@spksaw.sch.id" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;color:#0d1117;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                @error('email')<div style="color:#dc2626;font-size:11.5px;margin-top:5px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">NIP <span style="color:#dc2626;">*</span></label>
                <input type="text" name="nip" value="{{ old('nip') }}" placeholder="198502142010011002" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;color:#0d1117;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                @error('nip')<div style="color:#dc2626;font-size:11.5px;margin-top:5px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Jurusan (Opsional)</label>
                <select name="jurusan_id" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;color:#0d1117;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a href="{{ route('admin.gurubk.index') }}" style="padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;border:1.5px solid #e2e8f0;color:#64748b;text-decoration:none;">Batal</a>
                <button type="submit" style="padding:9px 22px;border-radius:9px;font-size:12.5px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;">✓ Simpan Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection