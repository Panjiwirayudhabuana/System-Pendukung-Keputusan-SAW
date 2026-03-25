@extends('layouts.admin')
@section('title','Edit Guru BK')
@section('content')
<div style="max-width:640px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.gurubk.index') }}" style="font-size:12px;color:#2563eb;text-decoration:none;">← Kembali</a>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;margin-top:8px;">Edit Guru BK</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-03, FR-A-04, FR-A-05 · Edit profil, kredensial, dan jurusan</p>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <form method="POST" action="{{ route('admin.gurubk.update', $guruBk->id) }}">
            @csrf @method('PUT')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $guruBk->user->nama) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                    @error('nama')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">NIP *</label>
                    <input type="text" name="nip" value="{{ old('nip', $guruBk->nip) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Email *</label>
                <input type="email" name="email" value="{{ old('email', $guruBk->user->email) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                @error('email')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:16px;">
    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:6px;">
        Jurusan
    </label>

    <select name="jurusan_id" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:8px;">
        
        @foreach($jurusans as $j)
            <option value="{{ $j->id }}" {{ old('jurusan_id', $guruBk->jurusan_id) == $j->id ? 'selected' : '' }}>
                {{ $j->nama_jurusan }}
            </option>
        @endforeach

    </select>
</div>

            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:9px;padding:14px 16px;margin-bottom:16px;">
                <div style="font-size:11.5px;font-weight:700;color:#92400e;margin-bottom:8px;">🔒 Reset Password (FR-A-04)</div>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="width:100%;background:#fff;border:1.5px solid #fde68a;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;">
                <div style="font-size:11px;color:#92400e;margin-top:5px;">Jika diisi, Guru BK akan diwajibkan ganti password saat login berikutnya.</div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a href="{{ route('admin.gurubk.index') }}" style="padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;border:1.5px solid #e2e8f0;color:#64748b;text-decoration:none;">Batal</a>
                <button type="submit" style="padding:9px 22px;border-radius:9px;font-size:12.5px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;">✓ Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

